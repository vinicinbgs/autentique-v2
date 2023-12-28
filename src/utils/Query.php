<?php

namespace vinicinbgs\Autentique\Utils;

use Exception;

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
            throw new Exception("File '$file' is not found", 404);
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
     * set Variables in query adding value
     *
     * @param string|array $variables
     * @param string|array $value
     * @param string $graphQuery
     * @return string
     */
    public function setVariables($variables, $value, string $graphQuery): string
    {
        if (is_array($variables) && is_array($value)) {
            $variablesLength = count($variables);

            for ($i = 0; $i < $variablesLength; $i++) {
                $variable = "\$" . $variables[$i];
                $graphQuery = str_replace($variable, $value[$i], $graphQuery);
            }
        } elseif (is_string($variables)) {
            $graphQuery = str_replace("\$" . $variables, $value, $graphQuery);
        }

        return $graphQuery;
    }
}
