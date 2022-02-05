<?php

namespace vinicinbgs\Autentique\Utils;

use CURLFile;

class Api
{
    const ACCEPT_CONTENTS = ["json", "form"];
    const CONTENT_TYPE_ERROR_MSG = "This content-type not exist";
    const EMPTY_QUERY_ERROR_MSG = "Query cannot be empty string";

    public static function request(
        string $token,
        string $query,
        string $contentType,
        string $pathFile = null
    ) {
        if (!in_array($contentType, self::ACCEPT_CONTENTS)) {
            return self::CONTENT_TYPE_ERROR_MSG;
        }

        if (empty($query)) {
            return self::EMPTY_QUERY_ERROR_MSG;
        }

        $httpHeader = ["Authorization: Bearer {$token}"];

        $fields = '{"query":' . $query . "}";

        if ($contentType == "json") {
            $contentType = self::requestJson();
            array_push($httpHeader, $contentType);
        } else {
            $contentType = self::requestFormData();
            $fields = [
                "operations" => $fields,
                "map" => '{"file": ["variables.file"]}',
                "file" => new CURLFile($pathFile),
            ];
        }

        return self::connect($httpHeader, $fields);
    }

    private static function connect(array $httpHeader, $fields)
    {
        $curl = curl_init();

        curl_setopt_array(
            /** @scrutinizer ignore-type */
            $curl,
            [
                CURLOPT_URL => self::url(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => $httpHeader,
                CURLOPT_CAINFO => __DIR__ . "/../../ssl/ca-bundle.crt",
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

        if (!empty($error)) {
            $response = json_encode([
                "status" => 400,
                "message" => !empty($error)
                    ? $error
                    : "CURL return false, maybe you need to check the ssl cert",
            ]);
        }

        return $response;
    }

    private static function url(): ?string
    {
        return getenv("AUTENTIQUE_URL") ?? null;
    }

    private static function requestJson(): string
    {
        return "Content-Type: application/json";
    }

    private static function requestFormData(): string
    {
        return "Content-Type: multipart/form-data";
    }
}
