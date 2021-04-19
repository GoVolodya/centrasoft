<?php


namespace app\core;


class Application
{
    /**
     * Attributes for Application class.
     */
    public static Application $app;
    public static string $ROOT_DIR;
    public string $userClass;
    public string $layout = 'main';
    public Request $request;
    public Response $response;
    public Router $router;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?DbModel $user;
    public View $view;

    /**
     * Application constructor.
     * @param $rootPath
     * @param array $config
     */
    public function __construct($rootPath, array $config){
        $this->userClass = $config['userClass'];
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey=>$primaryValue]);
        }else{
            $this->user = null;
        }
    }

    /**
     * Methods for Application class.
     */

    /**
     * Base entry point to Application.
     */
    public function  run(){
        try {
            echo $this->router->resolve();
        }catch (\Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', ['exception' => $e]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @param DbModel $user
     * @return bool
     */
    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    /**
     * Logout user after click.
     */
    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }

    /**
     * @return bool
     */
    public static function isGuest(): bool
    {
        return !self::$app->user;
    }
}