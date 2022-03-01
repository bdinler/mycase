<?php

namespace App\Core;


use App\Exception\HttpException;
use App\Traits\Responder;
use Exception;

class Application
{
    use Responder;

    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * @return void
     */
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (HttpException $e) {
            http_response_code($e->getCode());
            echo $this->jsonResponse(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                $e->getCode()
            );
            die();
        } catch (Exception $e) {
            echo $this->jsonResponse(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                500
            );
            die();
        }
    }
}