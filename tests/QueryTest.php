<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;

use vinicinbgs\Autentique\Utils\Query;
use vinicinbgs\Autentique\Enums\ResourcesEnum;

class QueryTest extends Base
{
    public function testFileIsNotString()
    {
        $query = new Query(ResourcesEnum::DOCUMENTS);

        $resolve = $query->setQuery("test")->query();

        $this->assertStringMatchesFormat("File is not found", $resolve);
    }
}
