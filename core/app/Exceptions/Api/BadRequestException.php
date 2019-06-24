<?php

namespace App\Exceptions\Api;

use Throwable;

class BadRequestException extends ApiBaseException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->responseHttpCode = 400;
        $this->responseErrorCode = 45;
        $this->standardMessage = 'Bad request';
    }
}
