<?php

use vinicinbgs\Autentique\Api;

class ApiTest extends PHPUnit\Framework\TestCase
{
    private $token;

    public function setUp(): void
    {
        $this->token = getenv('AUTENTIQUE_TOKEN');
    }

    public function testPostFieldsNull()
    {
        $api = Api::request($this->token, '', 'notExist');

        $this->assertStringMatchesFormat(
            'The postfield field cannot be null',
            $api
        );
    }
}
