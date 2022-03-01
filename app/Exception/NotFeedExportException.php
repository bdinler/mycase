<?php

namespace App\Exception;


class NotFeedExportException extends HttpException
{
    protected $message = 'This Feed Type Not Found';
    protected $code = 422;
}