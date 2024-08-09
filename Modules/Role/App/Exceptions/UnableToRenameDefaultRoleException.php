<?php

namespace Modules\Role\App\Exceptions;

use Exception;

class UnableToRenameDefaultRoleException extends Exception
{
    public function __construct($message = 'Role update failed', $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
