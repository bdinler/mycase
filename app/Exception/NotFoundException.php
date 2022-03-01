<?php

namespace App\Exception;


class NotFoundException extends HttpException
{
    protected $message = 'Not Found';
    protected $code = 404;
}