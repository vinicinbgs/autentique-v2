<?php

namespace vinicinbgs\Autentique\tests;

use Exception;
use vinicinbgs\Autentique\tests\_Base;

use vinicinbgs\Autentique\Documents;
use vinicinbgs\Autentique\Folders;
use vinicinbgs\Autentique\Utils\Api;

class DocumentsTest extends _Base
{
    const ERROR_ARRAY_DOESNT_CONTAINS_DATA = 'Array doesn\'t contains "data" as key';

    /**
     * @var Documents
     */
    private $documents;

    /**
     * @var Folders
     */
    private $folders;

    private $autentiqueDocumentCreated;

    private function mockDocument(?int $organizationId = null)
    {
        return [
            "organization_id" => $organizationId,
            "document" => [
                "name" => "DOC. TEST",
            ],
            "signers" => [
                [
                    "email" => "dutra_morais@hotmail.com",
                    "action" => "SIGN",
                    "positions" => [
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "80", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "1", // Página da ASSINATURA
                        ],
                    ],
                ],
                [
                    "email" => "email@hotmail.com",
                    "action" => "SIGN",
                    "positions" => [
                        [
                            "x" => "50", // Posição do Eixo X da ASSINATURA (0 a 100)
                            "y" => "80", // Posição do Eixo Y da ASSINATURA (0 a 100)
                            "z" => "1", // Página da ASSINATURA
                        ],
                    ],
                ],
            ],
            "file" => __DIR__ . "/resources/document_test.pdf",
        ];
    }

    private function createDocument(?int $organizationId = null)
    {
        if ($this->autentiqueDocumentCreated) {
            return $this->autentiqueDocumentCreated;
        }

        $this->autentiqueDocumentCreated = $this->documents->create(
            $this->mockDocument($organizationId)
        );

        return $this->autentiqueDocumentCreated;
    }

    public function setUp(): void
    {
        $this->documents = new Documents();
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

        $this->assertArrayHasKey("data", $response, self::ERROR_ARRAY_DOESNT_CONTAINS_DATA);
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
     * Test Create Document in Autentique inside Organization
     * @return void
     */
    public function testCreateDocumentInsideOrganization(): void
    {
        $data = $this->createDocument(6390354);

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
        $attributes = $this->createDocument();

        $response = $this->documents->listById($attributes["data"]["createDocument"]["id"]);

        $this->assertArrayHasKey("data", $response, self::ERROR_ARRAY_DOESNT_CONTAINS_DATA);
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
        $this->assertTrue($response["data"]["signDocument"], "Expected true but return false");
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

        $this->assertTrue($response["data"]["deleteDocument"], "Expected true but return false");
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

    /**
     * @test
     *
     * Test move document from folder to another folder
     * @return void
     */
    public function testMoveToFolderByFolder(): void
    {
        $firstFolder = $this->folders->create([
            "folder" => [
                "name" => "test_1",
            ],
        ]);

        $secondFolder = $this->folders->create([
            "folder" => [
                "name" => "test_2",
            ],
        ]);

        $firstFolderId = $firstFolder["data"]["createFolder"]["id"];
        $secondFolderId = $secondFolder["data"]["createFolder"]["id"];

        $documentId = $this->createDocument()["data"]["createDocument"]["id"];

        $this->documents->moveToFolder($documentId, $firstFolderId);

        $response = $this->documents->moveToFolderByFolder(
            $documentId,
            $secondFolderId,
            $firstFolderId
        );

        $this->assertArrayHasKey("moveDocumentToFolder", $response["data"]);

        $this->assertTrue($response["data"]["moveDocumentToFolder"]);
    }

    /**
     * @test
     *
     * Test update document by id in Autentique
     * @return void
     */
    public function testUpdateDocument(): void
    {
        $id = $this->createDocument()["data"]["createDocument"]["id"];

        $name = "DOC. TEST UPDATED";
        $deadline = "2023-11-24T02:59:59.999Z";

        $response = $this->documents->update($id, [
            "document" => [
                "name" => $name,
                "deadline_at" => $deadline,
            ],
        ]);

        $this->assertArrayHasKey(
            "updateDocument",
            $response["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
        $this->assertTrue($response["data"]["updateDocument"]["name"] === $name);
        $this->assertTrue(
            $response["data"]["updateDocument"]["deadline_at"] === "2023-11-24T02:59:59.000000Z"
        );
    }

    /**
     * @test
     *
     * Test Add signer on document in Autentique
     * @return void
     */
    public function testAddSignerOnDocument(): void
    {
        $data = $this->createDocument();

        $sut = $this->documents->createSigner($data["data"]["createDocument"]["id"], [
            "signer" => [
                "email" => "test@test.com",
                "action" => "SIGN",
            ],
        ]);

        $this->assertArrayHasKey(
            "createDocument",
            $data["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );

        $this->assertArrayHasKey(
            "createSigner",
            $sut["data"],
            self::ERROR_ARRAY_DOESNT_CONTAINS_DATA
        );
    }

    /**
     * @test
     *
     * Test Add signer on document in Autentique
     * @return void
     */
    public function testDeleteSignerOnDocument(): void
    {
        $data = $this->createDocument();

        $addSigner = $this->documents->createSigner($data["data"]["createDocument"]["id"], [
            "signer" => [
                "email" => "test@test.com",
                "action" => "SIGN",
            ],
        ]);

        $sut = $this->documents->deleteSigner(
            $data["data"]["createDocument"]["id"],
            $addSigner["data"]["createSigner"]["public_id"]
        );

        $this->assertTrue($sut["data"]["deleteSigner"]);
    }

    /**
     * @test
     *
     * Test timeouted operation
     * @return void
     */
    public function testTimeoutedOperation(): void
    {
        // Arrange
        $document = (new Documents())->setApi(new Api("http://10.255.255.1", 1));

        // Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches("/Connection timed out/");

        // Act
        $document->listAll();
    }

    /**
     * @test
     *
     * Test invalid token
     * @return void
     */
    public function testSetInvalidToken(): void
    {
        // Arrange
        $document = (new Documents())->setToken("invalid_token");

        // Act
        $sut = $document->listAll();

        // Assert
        $this->assertEquals("unauthorized", $sut["message"]);
    }

    /**
     * @test
     *
     * Test invalid sandbox mode
     * @return void
     */
    public function testInvalidSandboxMode(): void
    {
        // Arrange
        $document = (new Documents())->setSandbox("invalid_sandbox_mode");

        // Act
        $sut = $document->listAll();

        // Assert
        $this->assertEquals(
            "Field \"documents\" argument \"showSandbox\" requires type Boolean, found invalid_sandbox_mode.",
            $sut["errors"][0]["message"]
        );
    }
}
