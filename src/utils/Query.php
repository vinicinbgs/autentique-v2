<?php

namespace vinicinbgs\Autentique\Utils;

class Query
{
    const DIR = "queries/";

    /** @var string */
    protected $resource;

    /** @var string */
    protected $file;

    /**
     * Query constructor.
     */
    public function __construct(string $resource)
    {
        $this->resource = __DIR__ . "/../" . self::DIR . strtolower($resource);
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
     * @param string $query
     * @return string|string[]|null
     */
    private function formatQueryRemoveBrokenLine(string $query)
    {
        return preg_replace("/[\n\r]/", "", $query);
    }

    /**
     * Set file query
     *
     * @param string $file
     * @return $this
     */
    public function setQuery(string $file)
    {
        $this->file = $file;

        return $this;
    }

    public function setVariables(
        string $variableName,
        $value,
        string $graphQuery
    ): string {
        $variableName = "$" . $variableName;

        return str_replace($variableName, $value, $graphQuery);
    }
}
