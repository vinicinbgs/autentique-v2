<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;
use vinicinbgs\Autentique\Api;

class ApiTest extends Base
{
    public function testPostFieldsNull()
    {
        $api = Api::request($this->token(), "", "notExist");

        $this->assertStringMatchesFormat(
            "The postfield field cannot be null",
            $api
        );
    }
}
