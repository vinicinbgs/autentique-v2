<?php

namespace vinicinbgs\Autentique;

use Api;

Class Documents
{
    private $QUERY;
    private $token;

    /**
     * Documents constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->QUERY = new Query();
        $this->token = $token;
    }

    /**
     * @return bool|string
     */
    public function listAll()
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();

        return Api::request($this->token, $graphQuery, 'json');
    }

    /**
     * @param string $documentId
     * @return bool|string
     */
    public function listById(string $documentId)
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
    }

    /**
     * @param array $attributes
     * @param string $pathPdf
     * @return string|string[]|null
     */
    public function create(array $attributes)
    {
        $variables = [
            'document' => [
                'name' => $attributes['document']['name']
            ],
            'signers' => [
                [
                    "email" => $attributes['signers']['email'],
                    "action" => "SIGN",
                    "positions" => [
                        [
                            "x" => $attributes['signers']['x'], // x axis
                            "y" => $attributes['signers']['y'], // y axis
                            "z" => $attributes['signers']['z']  // page number
                        ]
                    ]
                ]
            ],
            'file' => NULL,
        ];

        $graphMutation = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphMutation = str_replace('$variables', json_encode($variables), $graphMutation);
        $graphMutation = str_replace('$sandbox', getenv('AUTENTIQUE_DEV_MODE') ? 'true' : 'false', $graphMutation);

        return Api::request($this->token, $graphMutation, 'form', $attributes['file']);
    }

    /**
     * @param string $documentId
     * @return bool|string
     */
    public function signById(string $documentId)
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
    }

    /**
     * @param string $documentId
     * @return bool|string
     */
    public function deleteById(string $documentId)
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($this->token, $graphQuery, 'json');
    }
}