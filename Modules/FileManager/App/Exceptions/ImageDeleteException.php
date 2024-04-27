<?php

namespace Modules\FileManager\App\Exceptions;

use Exception;

class ImageDeleteException extends Exception
{
    public function __construct($message = "Image deletion failed", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
