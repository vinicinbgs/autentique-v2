<?php

namespace vinicinbgs\Autentique\tests;

use PHPUnit\Framework\TestCase;

class _Base extends TestCase
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

    protected function autentiqueUrl()
    {
        return getenv("AUTENTIQUE_URL");
    }
}
