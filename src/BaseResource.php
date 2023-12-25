<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Enums\ResourcesEnum;
use vinicinbgs\Autentique\Utils\Api;

class BaseResource
{
    /**
     * Autentique API
     * @var Api
     */
    protected $api;

    /**
     * Autentique API Token
     * @var string
     */
    protected $token;

    /**
     * Autentique Sandbox Mode
     * @var "true"|"false"
     */
    protected $sandbox;

    /**
     * Autentique Resources Enum
     * @var ResourcesEnum
     */
    protected $resourcesEnum;

    /**
     * @var string
     */
    public function __construct(string $token = null)
    {
        $this->api = new Api($_ENV["AUTENTIQUE_URL"] ?? "");
        $this->token = $token ?? $_ENV["AUTENTIQUE_TOKEN"];
        $this->sandbox = $_ENV["AUTENTIQUE_DEV_MODE"] ?? "false";

        $this->resourcesEnum = ResourcesEnum::class;
    }
}
