<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Resources\ResourcesEnum;
class Folders extends BaseResource
{
    private $query;
    private $token;

    /**
     * Documents constructor.
     *
     * @param $token
     */
    public function __construct(string $token)
    {
        $this->query = new Query(ResourcesEnum::FOLDERS);
        $this->token = $token;
    }

    /**
     * List all folders
     *
     * @param int $page
     * @return bool|string
     */
    public function listAll(int $page = 1)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();

        $graphQuery = str_replace('$page', $page, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return bool|string
     */
    public function listById(string $folderId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$folderId', $folderId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * List folder by id
     *
     * @param string $folderId
     *
     * @return bool|string
     */
    public function listContentsById(string $folderId, int $page = 1)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$folderId', $folderId, $graphQuery);
        $graphQuery = str_replace('$page', $page, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * Create folder
     *
     * @param array $fodlerName
     * @return bool|false|string
     */
    public function create(string $fodlerName)
    {
        $variables = [
            "folder" => [
                "name" => $fodlerName,
            ],
        ];

        $graphMutation = $this->query->setFile(__FUNCTION__)->query();
        $graphMutation = str_replace(
            '$variables',
            json_encode($variables),
            $graphMutation
        );
        $graphMutation = str_replace(
            '$sandbox',
            $this->sandbox,
            $graphMutation
        );

        return Api::request($this->token, $graphMutation, "json");
    }

    /**
     * Delete folder by id
     *
     * @param string $folderId
     *
     * @return bool|string
     */
    public function deleteById(string $folderId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$folderId', $folderId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }
}
