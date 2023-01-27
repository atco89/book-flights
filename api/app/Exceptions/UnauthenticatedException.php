<?php

namespace App\Exceptions;

use Exception;

class UnauthenticatedException extends Exception
{

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "Unauthenticated", int $code = 401)
    {
        parent::__construct($message, $code);
    }
}