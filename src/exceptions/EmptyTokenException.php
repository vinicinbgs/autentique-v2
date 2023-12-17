<?php

namespace vinicinbgs\Autentique\exceptions;

use vinicinbgs\Autentique\Enums\ErrorMessagesEnum;

class EmptyTokenException extends BaseException
{
    public function __construct()
    {
        parent::__construct(ErrorMessagesEnum::ERR_TOKEN_EMPTY, 400);
    }
}
