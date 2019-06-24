<?php

namespace App\Exceptions\Api;

use Throwable;

class AuthorizationException extends ApiBaseException
{
    /** @var mixed Message for fail auth */
    public $failAuthMessage;

    /**
     * AuthorizationException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->responseHttpCode = 200;
        $this->failAuthMessage = [
            "non_field_errors" => [
                "Unable to log in with provided credentials."
            ]
        ];
    }
}
