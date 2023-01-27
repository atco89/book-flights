<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "Not found", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}