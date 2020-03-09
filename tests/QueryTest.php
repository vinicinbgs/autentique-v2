<?php

class QueryTest extends PHPUnit\Framework\TestCase
{
    public function testFileIsNotString()
    {
        $query = new \vinicinbgs\Autentique\Query();

        $resolve = $query->setFile('test')->query();

        $this->assertStringMatchesFormat('File is not found', $resolve);
    }
}
