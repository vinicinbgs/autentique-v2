<?php

namespace vinicinbgs\Autentique;

class Query
{
    /**
     * @var string
     */
    protected $resource;
    protected $file;

    /**
     * Query constructor.
     */
    public function __construct(string $resource)
    {
        $this->resource = __DIR__ . "/resources/" . strtolower($resource);
    }

    /**
     * Get query
     *
     * @return string|string[]|null
     */
    public function query()
    {
        if (!file_exists("$this->resource/$this->file")) {
            return "File is not found";
        }

        $query = file_get_contents("$this->resource/$this->file");

        return $this->formatQueryRemoveBrokenLine($query);
    }

    /**
     * Format query to remove LF (line feed \n) and CR (carriege return \r)
     *
     * @param $query
     * @return string|string[]|null
     */
    private function formatQueryRemoveBrokenLine($query)
    {
        return preg_replace("/[\n\r]/", "", $query);
    }

    /**
     * Set file query
     *
     * @param $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
