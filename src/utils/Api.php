<?php

namespace vinicinbgs\Autentique\Utils;

use CURLFile;
use Exception;

class Api
{
    const ACCEPT_CONTENTS = ["json", "form"];

    const ERR_CONTENT_TYPE = "This content-type not exist";
    const ERR_EMPTY_QUERY = "Query cannot be empty string";
    const ERR_AUTENTIQUE_URL = "AUTENTIQUE_URL cannot be empty";
    const ERR_CURL = "curl_exec return false, check the ssl cert or CURLOPT params";
    const ERR_URL_INVALID = "Invalid url";

    private $url;

    public function __construct(string $url)
    {
        $this->url = $this->setUrl($url);
    }

    public function request(
        string $token,
        string $query,
        string $contentType,
        string $pathFile = null
    ) {
        if (!in_array($contentType, self::ACCEPT_CONTENTS)) {
            return self::ERR_CONTENT_TYPE;
        }

        if (empty($query)) {
            return self::ERR_EMPTY_QUERY;
        }

        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            return [
                "status" => 400,
                "message" => self::ERR_URL_INVALID,
            ];
        }

        $httpHeader = ["Authorization: Bearer {$token}"];

        $fields = '{"query":' . $query . "}";

        if ($contentType == "json") {
            $contentType = $this->requestJson();
        } else {
            $contentType = $this->requestFormData();
            $fields = [
                "operations" => $fields,
                "map" => '{"file": ["variables.file"]}',
                "file" => new CURLFile($pathFile),
            ];
        }

        array_push($httpHeader, $contentType);

        return $this->connect($httpHeader, $fields);
    }

    private function connect(array $httpHeader, $fields)
    {
        $curl = curl_init();

        curl_setopt_array(
            /** @scrutinizer ignore-type */
            $curl,
            [
                CURLOPT_URL => $this->url,
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

        $errorNo = curl_errno($curl);

        if ($errorNo || $response == "[]") {
            $response = [
                "status" => 400,
                "message" => self::ERR_CURL,
            ];
        }

        curl_close(
            /** @scrutinizer ignore-type */
            $curl
        );

        return is_array($response) ? $response : json_decode($response, true);
    }

    private function setUrl(string $url)
    {
        if (empty($url)) {
            throw new Exception(self::ERR_AUTENTIQUE_URL, 400);
        }

        return $url;
    }

    public function requestJson(): string
    {
        return "Content-Type: application/json";
    }

    public function requestFormData(): string
    {
        return "Content-Type: multipart/form-data";
    }
}
