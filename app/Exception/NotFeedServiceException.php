<?php

namespace App\Exception;


class NotFeedServiceException extends HttpException
{
    protected $message = 'This Feed Export Not Found';
    protected $code = 422;
}