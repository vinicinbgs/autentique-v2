<?php

namespace vinicinbgs\Autentique\tests;

use PHPUnit\Framework\TestCase;

class _Base extends TestCase
{
    /** @var string */
    protected $token;

    public static function setUpBeforeClass(): void
    {
        try {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
            $dotenv->load();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function token()
    {
        return $_ENV["AUTENTIQUE_TOKEN"];
    }

    protected function autentiqueUrl()
    {
        return $_ENV["AUTENTIQUE_URL"];
    }
}
