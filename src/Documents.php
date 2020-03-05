<?php

namespace vinicinbgs\Autentique;

use Api;

Class Documents
{
    private $QUERY;

    public function __construct()
    {
        $this->QUERY = new Query();
    }

    public function listAll()
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();

        return Api::request($graphQuery, 'json');
    }

    /**
     * @param string $documentId
     * @return bool|string
     */
    public function listById(string $documentId)
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        return Api::request($graphQuery, 'json');
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

        return Api::request($graphMutation, 'form', $attributes['file']);
    }

    public function signById(string $documentId)
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }

    public function deleteById(string $documentId)
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }
}