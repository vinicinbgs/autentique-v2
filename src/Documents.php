<?php

namespace vinicinbgs\Autentique;

use Api;

class Documents
{
    private $QUERY;
    private $token;

    /**
     * Documents constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->QUERY = new Query();
        $this->token = $token;
    }

    /**
     * List all documents
     *
     * @return bool|string
     */
    public function listAll($page = 1)
    {   
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();

        $graphQuery = str_replace('$page', $page, $graphQuery);
        
        return Api::request($this->token, $graphQuery, 'json');
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
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
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
            'document' => [
                'name' => $attributes['document']['name'],
            ],
            'signers' => [
                [
                    'email' => $attributes['signers']['email'],
                    'action' => 'SIGN',
                    'positions' => [],
                ],
            ],
            'file' => null,
        ];

        foreach ($attributes['signers']['positions'] as $k => $position) {
            array_push($variables['signers'][0]['positions'], $position);
        }

        $graphMutation = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphMutation = str_replace('$variables', json_encode($variables), $graphMutation);
        $graphMutation = str_replace('$sandbox', getenv('AUTENTIQUE_DEV_MODE') ? 'true' : 'false', $graphMutation);

        return Api::request($this->token, $graphMutation, 'form', $attributes['file']);
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
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
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
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
    }
}
