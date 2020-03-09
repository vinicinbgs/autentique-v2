<?php

class DocumentTest extends PHPUnit\Framework\TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function testListAll()
    {
        $documents = new vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $data = json_decode($documents->listAll(), true);

        $this->assertArrayHasKey('data', $data, 'Array doesn\'t contains "data" as key');
    }

    public function testCreateDocument()
    {
        $documents = new vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $attributes = [
            'document' => [
                'name' => 'Package Autentique V2',
            ],
            'signers' => [
                'email'     => 'dutra_morais@hotmail.com',
                'positions' => [
                    ['x' => '50', 'y' => '80', 'z' => '1'],
                    ['x' => '50', 'y' => '50', 'z' => '2'],
                ],
            ],
            'file' => 'C:\Users\dutra\Downloads\A internet das coisas.pdf',
        ];

        $data = json_decode($documents->create($attributes), true);

        var_dump($data['data']);

        $this->assertArrayHasKey('createDocument', $data['data'], 'Array doesn\'t contains "createDocument" as key');
    }
}
