<?php

use vinicinbgs\Autentique\tests\_Base;
use vinicinbgs\Autentique\Folders;

class FoldersTest extends _Base
{
    private $folders;

    private function mockFolder()
    {
        return [
            "folder" => [
                "name" => date("YmdHis"),
            ],
        ];
    }

    private function createFolder()
    {
        return $this->folders->create($this->mockFolder());
    }

    public function setUp(): void
    {
        $this->folders = new Folders($this->token());
    }

    public function testListAll(): void
    {
        $this->createFolder();

        $response = $this->folders->listAll();

        $this->assertArrayHasKey("data", $response);
    }

    public function testCreate(): void
    {
        $response = $this->createFolder();

        $this->assertArrayHasKey("createFolder", $response["data"]);

        $this->folders->deleteById($response["data"]["createFolder"]["id"]);
    }

    public function testListById(): void
    {
        $folder = $this->createFolder();

        $response = $this->folders->listById($folder["data"]["createFolder"]["id"]);

        $this->assertArrayHasKey("data", $response);

        $this->folders->deleteById($folder["data"]["createFolder"]["id"]);
    }

    public function testContentsById(): void
    {
        $folder = $this->createFolder();

        $response = $this->folders->listContentsById($folder["data"]["createFolder"]["id"]);

        $this->assertArrayHasKey("data", $response);

        $this->folders->deleteById($folder["data"]["createFolder"]["id"]);
    }

    public function testDeleteById(): void
    {
        $folder = $this->createFolder();

        $response = $this->folders->deleteById($folder["data"]["createFolder"]["id"]);

        $this->assertArrayHasKey("data", $response);
    }
}
