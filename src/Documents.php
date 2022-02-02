<?php

namespace vinicinbgs\Autentique;

class Documents extends BaseResource
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
        parent::__construct();

        $this->query = new Query($this->resourcesEnum::DOCUMENTS);
        $this->token = $token;
    }

    /**
     * List all documents
     *
     * @param  int  $page
     * @return bool|string
     */
    public function listAll(int $page = 1)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();

        $graphQuery = str_replace('$page', $page, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * List document by id
     *
     * @param string $documentId
     *
     * @return bool|string
     */
    public function listById(string $documentId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * Create Document
     *
     * @param array $attributes
     * @return bool|false|string
     */
    public function create(array $attributes)
    {
        $variables = [
            "document" => $attributes["document"],
            "signers" => $attributes["signers"],
            "file" => null,
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

        return Api::request(
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
     * @return bool|string
     */
    public function signById(string $documentId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * Delete document by id
     *
     * @param string $documentId
     *
     * @return bool|string
     */
    public function deleteById(string $documentId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }

    /**
     * Move document to folder
     *
     * @param string $documentId
     * @param string $folderId
     *
     * @return bool|string
     */
    public function moveToFolder(string $documentId, string $folderId)
    {
        $graphQuery = $this->query->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);
        $graphQuery = str_replace('$folderId', $folderId, $graphQuery);

        return Api::request($this->token, $graphQuery, "json");
    }
}
