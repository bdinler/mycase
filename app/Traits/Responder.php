<?php

namespace App\Traits;


trait Responder
{
    /**
     * @param $data
     * @param int $statusCode
     * @return false|string
     */
    public function jsonResponse($data, int $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');

        return json_encode($data);
    }

    /**
     * @param $xml
     * @return mixed
     */
    public function xmlResponse($xml)
    {
        header('Content-Type: application/xml; charset=utf-8');

        return $xml;
    }
}