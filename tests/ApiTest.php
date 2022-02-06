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
        $response = $this->api->request($this->token(), "", "notExist");

        $this->assertStringMatchesFormat(Api::ERR_CONTENT_TYPE, $response);
    }

    public function testQueryEmpty()
    {
        $response = $this->api->request($this->token(), "", "json");

        $this->assertStringMatchesFormat(Api::ERR_EMPTY_QUERY, $response);
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
        $response = $this->api->request($this->token(), "test", "json");

        $this->assertArrayHasKey("status", $response);
        $this->assertArrayHasKey("message", $response);

        $this->assertEquals(Api::ERR_CURL, $response["message"]);
    }

    public function testUrlMalformed()
    {
        $mockApi = new Api("htt");
        $response = $mockApi->request($this->token(), "query", "json");

        $this->assertArrayHasKey("status", $response);
        $this->assertArrayHasKey("message", $response);

        $this->assertEquals(Api::ERR_URL_INVALID, $response["message"]);
    }
}
