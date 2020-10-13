<?php

use vinicinbgs\Autentique\Api;

class ApiTest extends PHPUnit\Framework\TestCase
{
    private $token;

    public function setUp()
    {
        $this->token =  getenv('AUTENTIQUE_TOKEN');
    }

    public function testPostFieldsNull()
    {
        $api = Api::request($this->token, '', 'notExist');

        $this->assertStringMatchesFormat('The postfield field cannot be null', $api);
    }

    public function testCurlReturnFalse()
    {
        putenv('AUTENTIQUE_URL=');

        $api = Api::request($this->token, '', 'json');

        $this->assertStringMatchesFormat('{"message":"CURL return false"}', $api);

        putenv('AUTENTIQUE_URL=https://api.autentique.com.br/v2/graphql');
    }
}
