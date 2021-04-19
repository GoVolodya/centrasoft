<?php


namespace app\core\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    /**
     * Attributes for AuthMiddleware class.
     */
    public array $actions = [];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = []){
        $this->actions = $actions;
    }

    /**
     * Methods for AuthMiddleware class.
     */

    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) or in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}