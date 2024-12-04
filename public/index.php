<?php

use app\controllers\Api\RegisterUserController;
use app\controllers\Api\TaskController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createMutable(dirname(__DIR__));
$dotenv->load();

$config = [
    "db_port" => $_ENV['DB_PORT'],
    "db_password" => $_ENV['DB_PASSWORD'],
    "db_user" => $_ENV['DB_USER'],
    "db_name" => $_ENV['DB_NAME'],
    "db_host" => $_ENV['DB_HOST'],
];

$app = new Application(dirname(__DIR__), $config);


$app->router->post('/api/user/register', [RegisterUserController::class, 'register']);
$app->router->post('/api/task/create', [TaskController::class, 'create']);
$app->router->get('/api/task/lists', [TaskController::class, 'lists']);
$app->router->post('/api/task/edit', [TaskController::class, 'update']);



$app->run();