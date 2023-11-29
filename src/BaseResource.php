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
    protected $sandbox;

    /**
     * @var string
     */
    protected $resourcesEnum;

    public function __construct()
    {
        $this->api = new Api($_ENV["AUTENTIQUE_URL"] ?? "");

        $this->sandbox = $_ENV["AUTENTIQUE_DEV_MODE"] ?? "false";

        $this->resourcesEnum = ResourcesEnum::class;
    }
}
