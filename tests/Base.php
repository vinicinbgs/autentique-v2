<?php

namespace vinicinbgs\Autentique\tests;

use PHPUnit\Framework\TestCase;

class Base extends TestCase
{
    /** @var string */
    protected $token;

    public static function setUpBeforeClass(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
        $dotenv->load();
    }

    protected function token()
    {
        return getenv("AUTENTIQUE_TOKEN");
    }
}