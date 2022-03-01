<?php

namespace App\Core;


class Request
{
    private array $routeParams = [];

    /**
     * @return false|mixed|string
     */
    public function getRequestUrl()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @param $params
     * @return $this
     */
    public function setRouteParams($params): Request
    {
        $this->routeParams = $params;
        return $this;
    }

    /**
     * @param $param
     * @param $default
     * @return mixed|null
     */
    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}