<?php

namespace App;

require __DIR__ . '\..\vendor\autoload.php';

use Api;

Class Documents extends Query
{
    private $QUERY;

    public function __construct()
    {
        $this->QUERY = new Query();
    }

    public function listAll()
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }

    public function listById($documentId)
    {
        $graphQuery = $this->QUERY->setFile(__FUNCTION__)->query();
        $graphQuery = str_replace('$documentId', $documentId, $graphQuery);

        $response = Api::request($graphQuery, 'json');

        return json_encode($response);
    }

    public function create()
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }

    public function signById()
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }

    public function deleteById()
    {
        return $this->QUERY->setFile(__FUNCTION__)->query();
    }
}