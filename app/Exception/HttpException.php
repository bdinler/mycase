<?php

namespace App\Exception;

use PHPUnit\Framework\Exception;
use Throwable;

class HttpException extends  Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}