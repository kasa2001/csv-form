<?php


namespace App\Exception;

use Throwable;

class FileExtensionException extends AbstractFileException
{

    public function __construct($message = "Wrong file extension", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}