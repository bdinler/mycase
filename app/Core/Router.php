<?php

namespace App\Core;


use App\Exception\NotFoundException;

class Router
{
    public Request $request;
    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $requestMethod
     * @param string $route
     * @param $callback
     * @return $this
     */
    public function register(string $requestMethod, string $route, $callback): Router
    {
        $this->routes[$requestMethod][$route] = $callback;

        return $this;
    }

    /**
     * @param $path
     * @param $callback
     * @return $this|Router
     */
    public function get($path, $callback)
    {
        return $this->register('get', $path, $callback);
    }

    /**
     * @return false|mixed
     */
    private function callbackCheck()
    {
        $method = $this->request->getRequestMethod();
        $url = $this->request->getRequestUrl();
        $url = trim($url, '/');

        $routes = $this->routes[$method];

        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setRouteParams($routeParams);
                return $callback;
            }

        }
        return false;
    }

    /**
     * @return false|mixed
     * @throws NotFoundException
     */
    public function resolve()
    {
        $url = $this->request->getRequestUrl();
        $method = $this->request->getRequestMethod();
        $callback = $this->routes[$method][$url] ?? false;
        if(!$callback) {
            $callback = $this->callbackCheck();
            if (!$callback) {
                throw new NotFoundException('Not Found');
            }
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request);
    }
}