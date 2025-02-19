<?php

namespace App\Exceptions;

use Exception;

class ModelNotFound extends Exception
{
    //
    protected $code = 404;
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
