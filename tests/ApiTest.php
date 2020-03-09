<?php

class ApiTest extends PHPUnit\Framework\TestCase
{
    public function testPostFieldsNull()
    {
        $api = Api::request(getenv('AUTENTIQUE_TOKEN'), '', 'notExist');

        $this->assertStringMatchesFormat('The postfield field cannot be null', $api);
    }

    public function testCurlReturnFalse()
    {
        putenv('AUTENTIQUE_URL=');

        $api = Api::request(getenv('AUTENTIQUE_TOKEN'), '', 'json');

        $this->assertStringMatchesFormat('{"message":"CURL return false"}', $api);

        putenv('AUTENTIQUE_URL=https://api.autentique.com.br/v2/graphql');
    }
}
