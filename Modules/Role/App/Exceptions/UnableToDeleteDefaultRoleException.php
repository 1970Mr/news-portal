<?php

namespace Modules\Role\App\Exceptions;

use Exception;

class UnableToDeleteDefaultRoleException extends Exception
{
    public function __construct($message = 'Role delete failed', $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
