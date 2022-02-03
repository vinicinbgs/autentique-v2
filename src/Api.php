<?php

namespace vinicinbgs\Autentique;

use CURLFile;

class Api
{
    public static function request(
        string $token,
        string $query,
        string $contentType,
        string $pathFile = null
    ) {
        $httpHeader = ["Authorization: Bearer {$token}"];

        $postFields = null;

        switch ($contentType) {
            case "json":
                $postFields = '{"query":' . $query . "}";
                array_push($httpHeader, "Content-Type: application/json");
                break;
            case "form":
                $attributes = '{"query":' . $query . "}";
                $postFields = [
                    "operations" => $attributes,
                    "map" => '{"file": ["variables.file"]}',
                    "file" => new CURLFile($pathFile),
                ];
                break;
        }

        if (is_null($postFields)) {
            return "The postfield field cannot be null";
        }

        $curl = curl_init(getenv("AUTENTIQUE_URL"));

        curl_setopt_array(
            /** @scrutinizer ignore-type */
            $curl,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => $httpHeader,
                CURLOPT_CAINFO => __DIR__ . "/../ssl/ca-bundle.crt",
            ]
        );

        $response = curl_exec(
            /** @scrutinizer ignore-type */
            $curl
        );

        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close(
            /** @scrutinizer ignore-type */
            $curl
        );

        if (isset($error)) {
            return json_encode([
                "status" => 400,
                "message" => !empty($error)
                    ? $error
                    : "CURL return false, maybe you need to check the ssl cert",
            ]);
        }

        return $response;
    }
}
