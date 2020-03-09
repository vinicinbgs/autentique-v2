<?php

class DocumentTest extends PHPUnit\Framework\TestCase
{
    /**
     * @test
     *
     * Test List All Documents in Autentique
     */
    public function testListAll(): void
    {
        $documents = new vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $data = json_decode($documents->listAll(), true);

        $this->assertArrayHasKey('data', $data, 'Array doesn\'t contains "data" as key');
    }

    /**
     * @test
     *
     * Test Create Document in Autentique
     */
    public function testCreateDocument(): string
    {
        $documents = new vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $attributes = [
            'document' => [
                'name' => 'Package Autentique V2',
            ],
            'signers' => [
                'email' => 'vinicius.morais@liberfly.com.br',
                'positions' => [
                    ['x' => '50', 'y' => '80', 'z' => '1'],
                    ['x' => '50', 'y' => '50', 'z' => '2'],
                ],
            ],
            'file' => './tests/resources/document_test.pdf'
        ];

        $data = json_decode($documents->create($attributes), true);

        $this->assertArrayHasKey('createDocument', $data['data'], 'Array doesn\'t contains "createDocument" as key');

        return $data['data']['createDocument']['id'];
    }

    /**
     * @test
     *
     * @depends testCreateDocument
     * Test List Document by Id in Autentique
     * @param $lastDocumentId
     */
    public function testListById($lastDocumentId): void
    {
        $documents = new \vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $response = $documents->listById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey('data', $data, 'Array doesn\'t contains "data" as key');
    }

    /**
     * @test
     *
     * Test sign document by id in Autentique
     * @depends testCreateDocument
     * @param $lastDocumentId
     */
    public function testSignDocument($lastDocumentId): void
    {
        $documents = new \vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $response = $documents->signById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey('signDocument', $data['data'], 'Array doesn\'t contains "data" as key');
        $this->assertTrue($data['data']['signDocument'], 'Expected true but return false');
    }

    /**
     * @test
     *
     * Test remove document by id in Autentique
     * @depends testCreateDocument
     * @param $lastDocumentId
     */
    public function testRemoveDocument($lastDocumentId): void
    {
        $documents = new \vinicinbgs\Autentique\Documents(getenv('AUTENTIQUE_TOKEN'));

        $response = $documents->deleteById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey('deleteDocument', $data['data'], 'Array doesn\'t contains "data" as key');
        $this->assertTrue($data['data']['deleteDocument'], 'Expected true but return false');
    }
}
