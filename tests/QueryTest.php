<?php

namespace vinicinbgs\Autentique\tests;

use vinicinbgs\Autentique\tests\Base;

use vinicinbgs\Autentique\Query;
use vinicinbgs\Autentique\Resources\ResourcesEnum;
class QueryTest extends Base
{
    public function testFileIsNotString()
    {
        $query = new Query(ResourcesEnum::DOCUMENTS);

        $resolve = $query->setFile("test")->query();

        $this->assertStringMatchesFormat("File is not found", $resolve);
    }
}
