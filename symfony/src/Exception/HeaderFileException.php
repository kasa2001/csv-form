<?php


namespace App\Exception;

use Throwable;

class HeaderFileException extends AbstractFileException
{

    public function __construct($message = "Wrong csv header", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}