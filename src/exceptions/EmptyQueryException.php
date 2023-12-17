<?php

namespace vinicinbgs\Autentique\exceptions;

use vinicinbgs\Autentique\Enums\ErrorMessagesEnum;

class EmptyQueryException extends BaseException
{
    public function __construct()
    {
        parent::__construct(ErrorMessagesEnum::ERR_EMPTY_QUERY, 400);
    }
}
