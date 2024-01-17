<?php

namespace vinicinbgs\Autentique;

use vinicinbgs\Autentique\Utils\Query;
use vinicinbgs\Autentique\BaseResource;

/**
 * Class Documents
 * @package vinicinbgs\Autentique
 * @see https://beadev.net/autentique-v2/documents
 */
class Documents extends BaseResource
{
    /**
     * GraphQL Query
     * @var Query
     */
    private $query;

    /**
     * Documents constructor.
     *
     * @param string|null $token Autentique API Token
     * @param int $timeout=60 Request Timeout in seconds
     */
    public function __construct(string $token = null, int $timeout = 60)
    {
        parent::__construct($token, $timeout);

        $this->query = new Query($this->resourcesEnum::DOCUMENTS);
    }

    /**
     * List all documents
     * @api
     * @param  int  $page Page number (starts at 1)
     * @return array
     */
    public function listAll(int $page = 1): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["page", "sandbox"],
            [$page, $this->sandbox],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * List document by id
     * @api
     * @see https://docs.autentique.com.br/api/queries/resgatando-documentos#resgatando-um-documento-especifico
     * @param string $documentId Document UUID
     * @return array
     */
    public function listById(string $documentId): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("documentId", $documentId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create Document
     * @api
     * @see https://docs.autentique.com.br/api/mutations/criando-um-documento
     * @param array $attributes ["document", "signers", "file", "organization_id"]
     * @return array
     */
    public function create(array $attributes): array
    {
        $variables = [
            "document" => $attributes["document"],
            "signers" => $attributes["signers"],
            "file" => null,
        ];

        $queryFile = __FUNCTION__;

        if (isset($attributes["organization_id"]) && !empty($attributes["organization_id"])) {
            $variables["organization_id"] = $attributes["organization_id"];
            $queryFile = __FUNCTION__ . "WithOrganization";
        }

        $graphMutation = $this->query->query($queryFile);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "form", $attributes["file"]);
    }

    /**
     * Update Document
     * @api
     * @see https://docs.autentique.com.br/api/mutations/editando-um-documento Attributes
     * @param string $id        Document UUID
     * @param array $attributes ["document"]
     * @return array
     */
    public function update(string $id, array $attributes): array
    {
        $variables = [
            "id" => $id,
            "document" => $attributes["document"],
        ];

        $graphMutation = $this->query->query(__FUNCTION__);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "json");
    }

    /**
     * Sign document by id
     * @api
     * @see https://docs.autentique.com.br/api/mutations/assinando-um-documento
     * @param string $documentId Document UUID
     * @return array
     */
    public function signById(string $documentId): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);
        $graphQuery = $this->query->setVariables("documentId", $documentId, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Delete document by id
     * @api
     * @param string $documentId Document UUID
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
     * @api
     * @see https://docs.autentique.com.br/api/mutations/movendo-documento-para-pasta
     * @param string $documentId Document UUID
     * @param string $folderId Folder UUID
     * @return array
     */
    public function moveToFolder(string $documentId, string $folderId): array
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
     * @api
     * @see https://docs.autentique.com.br/api/mutations/movendo-documento-para-pasta
     * @param string $documentId Document UUID
     * @param string $folderId Folder UUID
     * @param string $currentFolderId Current Folder UUID
     * @return array
     */
    public function moveToFolderByFolder(
        string $documentId,
        string $folderId,
        string $currentFolderId
    ): array {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["documentId", "folderId", "currentFolderId"],
            [$documentId, $folderId, $currentFolderId],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Delete signer from document
     * @api
     * @param string $documentId Document UUID
     * @param string $signerPublicId Signer Public UUID
     * @return array
     */
    public function deleteSigner(string $documentId, string $signerPublicId): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables(
            ["documentId", "signerPublicId"],
            [$documentId, $signerPublicId],
            $graphQuery
        );

        return $this->api->request($this->token, $graphQuery, "json");
    }

    /**
     * Create signer to document
     * @api
     * @param string $documentId Document UUID
     * @param array $signer Signer attributes
     * @return array
     */
    public function createSigner(string $documentId, array $attributes): array
    {
        $variables = [
            "document_id" => $documentId,
            "signer" => $attributes["signer"],
        ];

        $graphMutation = $this->query->query(__FUNCTION__);

        $graphMutation = $this->query->setVariables(
            ["variables"],
            [json_encode($variables)],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "json");
    }
}
