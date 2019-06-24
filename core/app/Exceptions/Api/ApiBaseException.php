<?php

namespace App\Exceptions\Api;

use Exception;

/**
 * Class ApiBaseException
 *
 * All API exceptions must extend this class
 *
 * @package App\Exceptions\Api
 */
class ApiBaseException extends Exception
{
    /** @var int Http code for response */
    public $responseHttpCode;

    /** @var int Error code for response */
    public $responseErrorCode;

    /** @var string Standard response message */
    public $standardMessage = '';
}
