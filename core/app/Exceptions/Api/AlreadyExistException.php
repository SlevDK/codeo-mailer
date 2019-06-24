<?php

namespace App\Exceptions\Api;

use Throwable;

class AlreadyExistException extends ApiBaseException
{
    /**
     * AlreadyExistException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->responseHttpCode = 400;
        $this->responseErrorCode = 33;
    }
}
