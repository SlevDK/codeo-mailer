<?php

namespace App\Exceptions\Api;

use Throwable;

class UnauthorizedException extends ApiBaseException
{
    /**
     * UnauthorizedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->responseHttpCode = 403;
        $this->responseErrorCode = 43;
        $this->standardMessage = 'Unauthorized';
    }
}
