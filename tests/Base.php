<?php

namespace vinicinbgs\Autentique\tests;

use PHPUnit\Framework\TestCase;

class Base extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();
    }
}
