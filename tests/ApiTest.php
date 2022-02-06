<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\_Base;
use vinicinbgs\Autentique\Utils\Api;

class ApiTest extends _Base
{
    public function instanceApi()
    {
        return new Api(getenv("AUTENTIQUE_URL"));
    }

    public function testContentTypeNotExist()
    {
        $api = $this->instanceApi()->request($this->token(), "", "notExist");

        $this->assertStringMatchesFormat(Api::ERR_CONTENT_TYPE, $api);
    }

    public function testQueryEmpty()
    {
        $api = $this->instanceApi()->request($this->token(), "", "json");

        $this->assertStringMatchesFormat(Api::ERR_EMPTY_QUERY, $api);
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
        $stub = $this->createPartialMock(Api::class, ["requestJson"]);

        $stub->method("requestJson")->willReturn("error");

        $api = $stub->request($this->token(), "query", "json");

        $this->assertArrayHasKey("status", $api);
        $this->assertArrayHasKey("message", $api);

        $this->assertEquals(Api::ERR_CURL, $api["message"]);
    }
}
