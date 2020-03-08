<?php

class DocumentTest extends PHPUnit\Framework\TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        //$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '\..\src\.env');
        //$dotenv->load();
    }

    /**
     * @test
     */
    public function testListAll()
    {
        $data = json_decode((new vinicinbgs\Autentique\Documents('1AAA95DCA22EAD45836A01A561BCE34B36DEF038CCC59B07A04670305F4834A6'))->listAll(), true);

        $this->assertArrayHasKey('data', $data);
    }
}
