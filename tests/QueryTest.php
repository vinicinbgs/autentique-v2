<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\_Base;

use vinicinbgs\Autentique\Utils\Query;
use vinicinbgs\Autentique\Enums\ResourcesEnum;

class QueryTest extends _Base
{
    public function testFileIsNotFound()
    {
        // Arrange
        $fileName = "file-not-found";
        $query = new Query(ResourcesEnum::DOCUMENTS);

        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("File '$fileName' is not found");

        // Act
        $query->query($fileName);
    }
}
