<?php

use vinicinbgs\Autentique\Documents;

class DocumentTest extends PHPUnit\Framework\TestCase
{
    private $token;

    public function setUp(): void
    {
        $this->token = $_ENV['AUTENTIQUE_TOKEN'];
    }

    /**
     * @test
     *
     * Test List All Documents in Autentique
     */
    public function testListAll(): void
    {
        $documents = new Documents($this->token);

        $data = json_decode($documents->listAll(1), true);

        $this->assertArrayHasKey(
            'data',
            $data,
            'Array doesn\'t contains "data" as key'
        );
    }

    /**
     * @test
     *
     * Test Create Document in Autentique
     */
    public function testCreateDocument(): string
    {
        $documents = new Documents($this->token);

        $attributes = [
            'document' => [
                'name' => 'NOME DO DOCUMENTO',
            ],
            'signers' => [
                [
                    'email' => 'email@email.com',
                    'action' => 'SIGN',
                    'positions' => [
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '1', // Página da ASSINATURA
                        ],
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '2', // Página da ASSINATURA
                        ],
                    ],
                ],
                [
                    'email' => 'email@email.com',
                    'action' => 'SIGN',
                    'positions' => [
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '1', // Página da ASSINATURA
                        ],
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '2', // Página da ASSINATURA
                        ],
                    ],
                ],
            ],
            'file' => './dummy.pdf',
        ];

        $data = json_decode($documents->create($attributes), true);

        $this->assertArrayHasKey(
            'createDocument',
            $data['data'],
            'Array doesn\'t contains "createDocument" as key'
        );

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
        $documents = new Documents($this->token);

        $response = $documents->listById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey(
            'data',
            $data,
            'Array doesn\'t contains "data" as key'
        );
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
        $documents = new Documents($this->token);

        $response = $documents->signById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey(
            'signDocument',
            $data['data'],
            'Array doesn\'t contains "data" as key'
        );
        $this->assertTrue(
            $data['data']['signDocument'],
            'Expected true but return false'
        );
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
        $documents = new Documents($this->token);

        $response = $documents->deleteById($lastDocumentId);

        $data = json_decode($response, true);

        $this->assertArrayHasKey(
            'deleteDocument',
            $data['data'],
            'Array doesn\'t contains "data" as key'
        );

        $this->assertTrue(
            $data['data']['deleteDocument'],
            'Expected true but return false'
        );
    }
}
