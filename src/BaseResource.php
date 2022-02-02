<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Resources\ResourcesEnum;

class BaseResource
{
    protected $sandbox;

    protected $resourcesEnum;

    public function __construct()
    {
        $this->sandbox = getenv("AUTENTIQUE_DEV_MODE") ? "true" : "false";

        $this->resourcesEnum = ResourcesEnum::class;
    }
}
