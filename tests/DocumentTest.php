<?php

class DocumentTest extends PHPUnit\Framework\TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '\..\src');
        $dotenv->load();
    }

    /**
     * @test
     */
    public function testListAll()
    {
        $data = json_decode((new vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN')))->listAll(), true);

        $this->assertArrayHasKey('data', $data);
    }
}
