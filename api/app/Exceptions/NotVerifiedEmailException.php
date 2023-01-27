<?php

namespace App\Exceptions;

use Exception;

class NotVerifiedEmailException extends Exception
{

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "Email not verified", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
