<?php


namespace app\core;


use app\core\middlewares\BaseMiddleware;

class Controller
{
    /**
     * Attributes for Controller class.
     */
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var $middlewares \app\core\middlewares\BaseMiddleware[]
     */
    public array $middlewares = [];

    /**
     * Methods for Controller class.
     */

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    /**
     * @param $layout
     */
    public function setLayout($layout){
        $this->layout = $layout;
    }

    /**
     * @param BaseMiddleware $middleware
     */
    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware;
    }
}