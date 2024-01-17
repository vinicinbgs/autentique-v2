<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Enums\ResourcesEnum;
use vinicinbgs\Autentique\Utils\Api;

abstract class BaseResource
{
    /**
     * Autentique API URL
     * @var string
     */
    public $autentiqueUrl = "https://api.autentique.com.br/v2/graphql";

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
     * @var string "true"|"false"
     */
    protected $sandbox;

    /**
     * Autentique Resources Enum
     * @var ResourcesEnum
     */
    protected $resourcesEnum;

    /**
     * BaseResource constructor.
     *
     * @param string|null $token Autentique API Token if not set or null it will get from $_ENV["AUTENTIQUE_TOKEN"]
     * @param int $timeout Request Timeout in seconds
     */
    public function __construct(string $token = null, int $timeout = 60)
    {
        $this->api = new Api($this->autentiqueUrl, $timeout);
        $this->setToken($token);
        $this->setSandbox();

        $this->resourcesEnum = ResourcesEnum::class;
    }

    /**
     * Set Autentique API Token but by default it will get from $_ENV["AUTENTIQUE_TOKEN"]
     * @param string $token Autentique API Token
     * @return $this
     */
    public function setToken(?string $token)
    {
        $this->token = $token ?? $_ENV["AUTENTIQUE_TOKEN"];
        return $this;
    }

    /**
     * Set Autentique Sandbox Mode but by default it will get from $_ENV["AUTENTIQUE_SANDBOX"]
     * @param string $sandbox "true"|"false"
     * @return $this
     */
    public function setSandbox(?string $sandbox = null)
    {
        $this->sandbox = $sandbox ?? ($_ENV["AUTENTIQUE_DEV_MODE"] ?? "false");
        return $this;
    }

    /**
     * Set Api instance customizing the Autentique API URL and Request Timeout
     *
     * @param Api $api
     * @return $this
     */
    public function setApi(Api $api)
    {
        $this->api = $api;
        return $this;
    }

    /**
     * Get Autentique API Token
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get Autentique Sandbox Mode
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getSandbox(): string
    {
        return $this->sandbox;
    }

    /**
     * Get Autentique API
     * @return Api
     *
     * @codeCoverageIgnore
     */
    public function getApi(): Api
    {
        return $this->api;
    }
}
