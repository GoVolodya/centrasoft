<?php
/**
 * This is a base starting point for our application.
 * It have autoloader for php classes, .env file support and routes for our site;
 */
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\models\User;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/student', [SiteController::class, 'student']);
$app->router->post('/student', [SiteController::class, 'student']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->get('/edit', [AuthController::class, 'edit']);
$app->router->post('/edit', [AuthController::class, 'edit']);
$app->router->get('/delete', [AuthController::class, 'delete']);


$app->run();