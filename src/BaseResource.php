<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Enums\ResourcesEnum;
use vinicinbgs\Autentique\Utils\Api;

class BaseResource
{
    /**
     * @var Api
     */
            protected $api;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $sandbox;

    /**
     * @var string
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
