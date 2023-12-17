<?php

namespace vinicinbgs\Autentique\exceptions;

use vinicinbgs\Autentique\Enums\ErrorMessagesEnum;

class InvalidAutentiqueUrlException extends BaseException
{
    public function __construct()
    {
        parent::__construct(ErrorMessagesEnum::ERR_URL_INVALID, 400);
    }
}
