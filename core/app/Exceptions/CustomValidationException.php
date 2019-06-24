<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CustomValidationException extends Exception
{
    /** @var array Validation errors */
    protected $errors;


    /**
     * Add array with errors
     *
     * @param array $errors
     * @return CustomValidationException
     */
    public function withErrors(array $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Retrieve array with errors
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
}
