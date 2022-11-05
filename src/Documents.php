<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Utils\Query;

class Documents extends BaseResource
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var string
     */
    private $token;

    /**
     * Documents constructor.
     *
     * @param $token
     */
    public function __construct(string $token = null)
    {
        parent::__construct();

        $this->query = new Query($this->resourcesEnum::DOCUMENTS);
        $this->token = $token ?? $_ENV["AUTENTIQUE_TOKEN"];
    }

    /**
     * List all documents
     *
     * @param  int  $page
     * @return bool|array
     */
    public function listAll(int $page = 1)
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables("page", $page, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List document by id
     *
     * @param string $documentId
     *
     * @return bool|array
     */
    public function listById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            "documentId",
            $documentId,
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create Document
     *
     * @param array $attributes
     * @return bool|array
     */
    public function create(array $attributes)
    {
        $variables = [
            "document" => $attributes["document"],
            "signers" => $attributes["signers"],
            "file" => null,
        ];

        $graphMutation = $this->query->query(__FUNCTION__);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request(
            $this->token,
            $graphMutation,
            "form",
            $attributes["file"]
        );
    }

    /**
     * Sign document by id
     *
     * @param string $documentId
     *
     * @return bool|array
     */
    public function signById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            "documentId",
            $documentId,
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Delete document by id
     *
     * @param string $documentId
     *
     * @return bool|array
     */
    public function deleteById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables(
            "documentId",
            $documentId,
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Move document to folder
     *
     * @param string $documentId
     * @param string $folderId
     *
     * @return bool|array
     */
    public function moveToFolder(string $documentId, string $folderId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["documentId", "folderId"],
            [$documentId, $folderId],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Move document from folder to folder
     *
     * @param string $documentId
     * @param string $folderId
     * @param string $currentFolderId
     *
     * @return bool|array
     */
    public function moveToFolderByFolder(string $documentId, string $folderId, string $currentFolderId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["documentId", "folderId", "currentFolderId"],
            [$documentId, $folderId, $currentFolderId],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }
}
