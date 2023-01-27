<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "Unauthorized", int $code = 403)
    {
        parent::__construct($message, $code);
    }
}