<?php

namespace vinicinbgs\Autentique\exceptions;

use vinicinbgs\Autentique\Enums\ErrorMessagesEnum;

class EmptyAutentiqueUrlException extends BaseException
{
    public function __construct()
    {
        parent::__construct(ErrorMessagesEnum::ERR_AUTENTIQUE_URL, 400);
    }
}
