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
    public function query(string $file)
    {
        if (!file_exists("$this->resource/$file") || empty($file)) {
            return "File is not found";
        }

        $query = file_get_contents("$this->resource/$file");

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
     * Undocumented function
     *
     * @param string|array $variableName
     * @param string|array $value
     * @param string $graphQuery
     * @return string
     */
    public function setVariables(
        $variableName,
        $value,
        string $graphQuery
    ): string {
        if (is_array($variableName) && is_array($value)) {
            for ($i = 0; $i < count($variableName); $i++) {
                $variable = "\$" . $variableName[$i];
                $graphQuery = str_replace($variable, $value[$i], $graphQuery);
            }
        } else {
            $graphQuery = str_replace(
                "\$" . $variableName,
                $value,
                $graphQuery
            );
        }

        return $graphQuery;
    }
}
