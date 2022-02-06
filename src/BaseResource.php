<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Enums\ResourcesEnum;
use vinicinbgs\Autentique\Utils\Api;

class BaseResource
{
    protected $api;

    protected $sandbox;

    protected $resourcesEnum;

    public function __construct()
    {
        $this->api = new Api(getenv("AUTENTIQUE_URL") ?? "");

        $this->sandbox = getenv("AUTENTIQUE_DEV_MODE") ?? "false";

        $this->resourcesEnum = ResourcesEnum::class;
    }
}
