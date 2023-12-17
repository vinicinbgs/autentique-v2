<?php

namespace vinicinbgs\Autentique\exceptions;

use \Exception;

class BaseException extends Exception
{
    /**
     * @param string $message
     * @param integer $code = 400
     */
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
