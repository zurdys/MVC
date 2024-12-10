<?php

declare(strict_types=1);

use App\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = new \PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../app/config/routes.php';

$pathInfo = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$controllerClass = $routes["$httpMethod|$pathInfo"];

$controller = new $controllerClass($videoRepository);
$controller->processaRequisicao();
