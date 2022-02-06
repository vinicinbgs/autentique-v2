<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\_Base;

use vinicinbgs\Autentique\Utils\Query;
use vinicinbgs\Autentique\Enums\ResourcesEnum;

class QueryTest extends _Base
{
    public function testFileIsNotFound()
    {
        $query = new Query(ResourcesEnum::DOCUMENTS);

        $resolve = $query->query("");

        $this->assertStringMatchesFormat("File is not found", $resolve);
    }
}
