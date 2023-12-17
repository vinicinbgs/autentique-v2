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
     * Documents constructor.
     *
     * @param string|null $token
     */
    public function __construct(string $token = null)
    {
        parent::__construct($token);

        $this->query = new Query($this->resourcesEnum::DOCUMENTS);
    }

    /**
     * List all documents
     *
     * @param  int  $page
     * @return array
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
     * @return array
     */
    public function listById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("documentId", $documentId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create Document
     * @link https://beadev.net/autentique-v2/documents#3---create-a-document
     * @link https://docs.autentique.com.br/api/mutations/criando-um-documento
     * @param array $attributes
     * @return array
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

        return $this->api->request($this->token, $graphMutation, "form", $attributes["file"]);
    }

    /**
     * Sign document by id
     *
     * @param string $documentId
     *
     * @return array
     */
    public function signById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("documentId", $documentId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Delete document by id
     *
     * @param string $documentId
     *
     * @return array
     */
    public function deleteById(string $documentId)
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("documentId", $documentId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Move document to folder
     *
     * @param string $documentId
     * @param string $folderId
     *
     * @return array
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
    public function moveToFolderByFolder(
        string $documentId,
        string $folderId,
        string $currentFolderId
    ) {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["documentId", "folderId", "currentFolderId"],
            [$documentId, $folderId, $currentFolderId],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }
}
