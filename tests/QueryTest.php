<?php

use vinicinbgs\Autentique\Query;

class QueryTest extends PHPUnit\Framework\TestCase
{
    public function testFileIsNotString()
    {
        $query = new Query();

        $resolve = $query->setFile('test')->query();

        $this->assertStringMatchesFormat('File is not found', $resolve);
    }
}
