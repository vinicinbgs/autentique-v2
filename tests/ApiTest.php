<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\_Base;
use vinicinbgs\Autentique\Utils\Api;

class ApiTest extends _Base
{
    private $api;

    public function setUp(): void
    {
        $this->api = new Api($this->autentiqueUrl());
    }

    public function testContentTypeNotExist()
    {
        $this->expectExceptionMessage(Api::ERR_CONTENT_TYPE);

        $this->api->request($this->token(), "", "notExist");
    }

    public function testQueryEmpty()
    {
        $this->expectExceptionMessage(Api::ERR_EMPTY_QUERY);

        $this->api->request($this->token(), "", "json");
    }

    public function testAutentiqueUrlException()
    {
        $factory = function () {
            return new Api("");
        };

        $this->expectExceptionMessage(Api::ERR_AUTENTIQUE_URL);

        $factory();
    }

    public function testCurlError()
    {
        $this->expectExceptionMessage(Api::ERR_CURL);

        $this->api->request($this->token(), "test", "json");
    }

    public function testUrlMalformed()
    {
        $this->expectExceptionMessage(Api::ERR_URL_INVALID);

        $mockApi = new Api("htt");

        $mockApi->request($this->token(), "query", "json");
    }
}
