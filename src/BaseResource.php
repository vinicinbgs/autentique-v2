<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Enums\ResourcesEnum;

class BaseResource
{
    protected $sandbox;

    protected $resourcesEnum;

    public function __construct()
    {
        $this->sandbox = getenv("AUTENTIQUE_DEV_MODE") ?? "false";

        $this->resourcesEnum = ResourcesEnum::class;
    }
}
