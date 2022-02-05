<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;
use vinicinbgs\Autentique\Utils\Api;

class ApiTest extends Base
{
    public function testPostFieldsNull()
    {
        $api = Api::request($this->token(), "", "notExist");

        $this->assertStringMatchesFormat(Api::CONTENT_TYPE_ERROR_MSG, $api);
    }
}
