<?php

namespace Modules\Auth\App\Exceptions;

use Exception;

class FailedLoginException extends Exception
{
    public function __construct(string $message = 'Failed login', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
