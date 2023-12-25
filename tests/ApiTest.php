<?php

namespace vinicinbgs\Autentique\tests;

use Exception;
use vinicinbgs\Autentique\tests\_Base;
use vinicinbgs\Autentique\Utils\Api;
use vinicinbgs\Autentique\Enums\ErrorMessagesEnum;
use vinicinbgs\Autentique\exceptions\ContentTypeException;

use Mockery;

class ApiTest extends _Base
{
    /**
     * @var Api
     */
    private $api;

    public function setUp(): void
    {
        $this->api = new Api($this->autentiqueUrl());
    }

    public function testContentTypeNotExist()
    {
        $this->expectException(ContentTypeException::class);

        $this->api->request($this->token(), "", "notExist");
    }

    public function testQueryEmpty()
    {
        $this->expectExceptionMessage(ErrorMessagesEnum::ERR_EMPTY_QUERY);

        $this->api->request($this->token(), "", "json");
    }

    public function testTokenEmpty()
    {
        $this->expectExceptionMessage(ErrorMessagesEnum::ERR_TOKEN_EMPTY);

        $this->api->request("", "", "json");
    }

    public function testAutentiqueUrlException()
    {
        $factory = function () {
            return new Api("");
        };

        $this->expectExceptionMessage(ErrorMessagesEnum::ERR_AUTENTIQUE_URL);

        $factory();
    }

    public function testAutentiqueEmptyResponse()
    {
        $this->expectExceptionMessage(ErrorMessagesEnum::ERR_AUTENTIQUE_RESPONSE);

        $this->api->request($this->token(), "teste", "json");
    }

    public function testAutentiqueValidationError()
    {
        $sut = $this->api->request($this->token(), "[]", "json");

        $this->assertArrayHasKey("errors", $sut);
    }

    public function testUrlMalformed()
    {
        $this->expectExceptionMessage(ErrorMessagesEnum::ERR_URL_INVALID);

        $mockApi = new Api("htt");

        $mockApi->request($this->token(), "query", "json");
    }

    public function testAutentiqueError()
    {
        // Arrange
        $stub = Mockery::mock(Api::class, [$this->autentiqueUrl()])->makePartial();
        $stub->shouldReceive("executeCurl")->andReturn("foo");
        $stub->shouldReceive("getErrorNo")->andReturn(1);

        // Assert
        $this->expectException(Exception::class);

        // Act
        $stub->request($this->token(), "[]", "json");
    }
}
