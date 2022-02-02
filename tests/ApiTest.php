<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;
use vinicinbgs\Autentique\Api;
class ApiTest extends Base
{
    private $token;

    public function setUp(): void
    {
        $this->token = getenv("AUTENTIQUE_TOKEN");
    }

    public function testPostFieldsNull()
    {
        $api = Api::request($this->token, "", "notExist");

        $this->assertStringMatchesFormat(
            "The postfield field cannot be null",
            $api
        );
    }
}
