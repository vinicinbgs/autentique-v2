<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;
use vinicinbgs\Autentique\Documents;

class DocumentTest extends Base
{
    const ERROR_ARRAY_DOESNT_CONTAINS_DATA = 'Array doesn\'t contains "data" as key';

    private $documents;

    private $autentiqueDocumentCreated;

    private function mockDocument()
    {
        return [
            "document" => [
                "name" => "NOME DO DOCUMENTO",
            ],
            "signers" => [
                [
                    "email" => "email@email.com",
                    "action" => "SIGN",
                    "positions" => [
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "80", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "1", // Página da ASSINATURA
                        ],
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "50", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "2", // Página da ASSINATURA
                        ],
                    ],
                ],
                [
                    "email" => "email@email.com",
                    "action" => "SIGN",
                    "positions" => [
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "80", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "1", // Página da ASSINATURA
                        ],
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "50", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "2", // Página da ASSINATURA
                        ],
                    ],
                ],
            ],
            "file" => "./tests/resources/document_test.pdf",
        ];
    }

    private function createDocument()
    {
        if ($this->autentiqueDocumentCreated) {
            return $this->autentiqueDocumentCreated;
        }

        $this->autentiqueDocumentCreated = $this->documents->create(
            $this->mockDocument()
        );

        return json_decode($this->autentiqueDocumentCreated, true);
    }

    public function setup(): void
    {
        $this->documents = new Documents($this->token());
    }

    /**
     * @test
     *
     * Test List All Documents in Autentique
     */
    public function testListAll(): void
    {
        $listAll = $this->documents->listAll(1);

        $data = json_decode($listAll, true);

        $this->assertArrayHasKey(
            "data",
            $data,
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
    }

    /**
     * @test
     *
     * Test Create Document in Autentique
     */
    public function testCreateDocument(): void
    {
        $data = $this->createDocument();

        $this->assertArrayHasKey(
            "createDocument",
            $data["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
    }

    /**
     * @test
     *
     * @depends testCreateDocument
     * Test List Document by Id in Autentique
     * @param $lastDocumentId
     */
    public function testListById(): void
    {
        $attributes = $this->createDocument($this->mockDocument());

        $data = $this->documents->listById(
            $attributes["data"]["createDocument"]["id"]
        );

        $response = json_decode($data, true);

        $this->assertArrayHasKey(
            "data",
            $response,
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
    }

    /**
     * @test
     *
     * Test sign document by id in Autentique
     * @depends testCreateDocument
     */
    public function testSignDocument(): void
    {
        $data = $this->documents->signById(
            $this->createDocument()["data"]["createDocument"]["id"]
        );

        $dataArray = json_decode($data, true);

        $this->assertArrayHasKey(
            "signDocument",
            $dataArray["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
        $this->assertTrue(
            $dataArray["data"]["signDocument"],
            "Expected true but return false"
        );
    }

    /**
     * @test
     *
     * Test remove document by id in Autentique
     * @depends testCreateDocument
     */
    public function testRemoveDocument(): void
    {
        $response = $this->documents->deleteById(
            $this->createDocument()["data"]["createDocument"]["id"]
        );

        $data = json_decode($response, true);

        $this->assertArrayHasKey(
            "deleteDocument",
            $data["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );

        $this->assertTrue(
            $data["data"]["deleteDocument"],
            "Expected true but return false"
        );
    }
}
