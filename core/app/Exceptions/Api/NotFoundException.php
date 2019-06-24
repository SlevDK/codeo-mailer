<?php

namespace App\Exceptions\Api;

use Throwable;

class NotFoundException extends ApiBaseException
{
    /**
     * NotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->responseHttpCode = 404;
        $this->responseErrorCode = 44;
        $this->standardMessage = 'Not found';
    }
}
