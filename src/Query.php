<?php

namespace vinicinbgs\Autentique;

Class Query
{
    /**
     * @var string
     */
    protected $folder, $file;

    /**
     * Query constructor.
     * @param $file
     */
    public function __construct()
    {
        $this->folder = __DIR__ . "\\resources\\documents\\";
    }

    /**
     * @return string|string[]|null
     */
    public function query()
    {
        $query = file_get_contents("$this->folder$this->file.graphqls");

        if (gettype($query) !== 'string')
            return 'This query is not a valid string';

        return $this->format($query);
    }

    /**
     * @param $query
     * @return string|string[]|null
     */
    private function format($query)
    {
        return preg_replace("/[\n\r]/", "", $query);
    }

    /**
     * @param $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}