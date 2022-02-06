<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\_Base;

use vinicinbgs\Autentique\Documents;
use vinicinbgs\Autentique\Folders;

class DocumentsTest extends _Base
{
    const ERROR_ARRAY_DOESNT_CONTAINS_DATA = 'Array doesn\'t contains "data" as key';

    private $documents;
    private $folders;

    private $autentiqueDocumentCreated;

    private function mockDocument()
    {
        return [
            "document" => [
                "name" => "DOC. TEST",
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
            "file" => __DIR__ . "/resources/document_test.pdf",
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

        return $this->autentiqueDocumentCreated;
    }

    public function setUp(): void
    {
        $this->documents = new Documents($this->token());
        $this->folders = new Folders($this->token());
    }

    /**
     * @test
     *
     * Test List All Documents in Autentique
     * @return void
     */
    public function testListAll(): void
    {
        $this->createDocument();

        $response = $this->documents->listAll(1);

        $this->assertArrayHasKey(
            "data",
            $response,
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
    }

    /**
     * @test
     *
     * Test Create Document in Autentique
     * @return void
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
     * Test List Document by Id in Autentique
     * @return void
     */
    public function testListById(): void
    {
        $attributes = $this->createDocument($this->mockDocument());

        $response = $this->documents->listById(
            $attributes["data"]["createDocument"]["id"]
        );

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
     * @return void
     */
    public function testSignDocument(): void
    {
        $response = $this->documents->signById(
            $this->createDocument()["data"]["createDocument"]["id"]
        );

        $this->assertArrayHasKey(
            "signDocument",
            $response["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
        $this->assertTrue(
            $response["data"]["signDocument"],
            "Expected true but return false"
        );
    }

    /**
     * @test
     *
     * Test remove document by id in Autentique
     * @return void
     */
    public function testRemoveDocument(): void
    {
        $response = $this->documents->deleteById(
            $this->createDocument()["data"]["createDocument"]["id"]
        );

        $this->assertArrayHasKey(
            "deleteDocument",
            $response["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );

        $this->assertTrue(
            $response["data"]["deleteDocument"],
            "Expected true but return false"
        );
    }

    /**
     * @test
     *
     * Test move document to folder
     * @return void
     */
    public function testMoveDocumentToFolder(): void
    {
        $folder = $this->folders->create([
            "folder" => [
                "name" => "test",
            ],
        ]);

        $folderId = $folder["data"]["createFolder"]["id"];

        $documentId = $this->createDocument()["data"]["createDocument"]["id"];

        $response = $this->documents->moveToFolder($documentId, $folderId);

        $this->assertArrayHasKey("moveDocumentToFolder", $response["data"]);

        $this->assertTrue($response["data"]["moveDocumentToFolder"]);
    }
}
