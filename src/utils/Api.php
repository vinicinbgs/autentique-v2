<?php

namespace vinicinbgs\Autentique\Utils;

use CURLFile;
use Exception;
use vinicinbgs\Autentique\exceptions\ContentTypeException;
use vinicinbgs\Autentique\exceptions\EmptyAutentiqueResponseException;
use vinicinbgs\Autentique\exceptions\EmptyAutentiqueUrlException;
use vinicinbgs\Autentique\exceptions\EmptyQueryException;
use vinicinbgs\Autentique\exceptions\EmptyTokenException;
use vinicinbgs\Autentique\exceptions\InvalidAutentiqueUrlException;

class Api
{
    const ACCEPT_CONTENTS = ["json", "form"];

    private $url;

    private $timeout = 60;

    /**
     * @param string $url Autentique API URL
     * @param int $timeout=60 seconds to timeout request
     */
    public function __construct(string $url, int $timeout = 60)
    {
        $this->url     = $this->setUrl($url);
        $this->timeout = $timeout;
    }

    /**
     * @param string $token
     * @param string $query
     * @param string $contentType json|form
     * @param string|null $pathFile
     * @return array
     */
    public function request(
        string $token,
        string $query,
        string $contentType,
        string $pathFile = null
    ): array {
        if (empty($token)) {
            throw new EmptyTokenException();
        }

        $this->validateParams($contentType, $query);

        $httpHeader = ["Authorization: Bearer {$token}"];

        $fields = '{"query":' . $query . "}";

        if ($contentType == "json") {
            $contentType = $this->requestJson();
        } else {
            $contentType = $this->requestFormData();
            $fields      = [
                "operations" => $fields,
                "map"        => '{"file": ["variables.file"]}',
                "file"       => new CURLFile($pathFile),
            ];
        }

        array_push($httpHeader, $contentType);

        return $this->connect($httpHeader, $fields);
    }

    /**
     * @param array $httpHeader
     * @param string|array $fields
     * @return array $response
     */
    private function connect(array $httpHeader, $fields): array
    {
        $curl = curl_init();

        curl_setopt_array(
            /** @scrutinizer ignore-type */
            $curl,
            [
                CURLOPT_URL            => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_CONNECTTIMEOUT => $this->timeout,
                CURLOPT_TIMEOUT        => $this->timeout,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => $fields,
                CURLOPT_HTTPHEADER     => $httpHeader,
                CURLOPT_CAINFO         => __DIR__ . "/../../ssl/ca-bundle.crt",
            ]
        );

        $response = $this->executeCurl($curl);

        $errorNo = $this->getErrorNo($curl);

        if ($response == "[]") {
            throw new EmptyAutentiqueResponseException();
        }

        if ($errorNo) {
            throw new Exception(curl_error($curl));
        }

        curl_close(
            /** @scrutinizer ignore-type */
            $curl
        );

        return json_decode($response, true);
    }

    private function setUrl(string $url): string
    {
        if (empty($url)) {
            throw new EmptyAutentiqueUrlException();
        }

        return $url;
    }

    private function validateParams(string $contentType, string $query): void
    {
        if (!in_array($contentType, self::ACCEPT_CONTENTS)) {
            throw new ContentTypeException();
        }

        if (empty($query)) {
            throw new EmptyQueryException();
        }

        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new InvalidAutentiqueUrlException();
        }
    }

    private function requestJson(): string
    {
        return "Content-Type: application/json";
    }

    private function requestFormData(): string
    {
        return "Content-Type: multipart/form-data";
    }

    public function getErrorNo($curl): int
    {
        return curl_errno(
            /** @scrutinizer ignore-type */
            $curl
        );
    }

    public function executeCurl($curl): string
    {
        return curl_exec(
            /** @scrutinizer ignore-type */
            $curl
        );
    }

    /**
     * Get the value of url
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
