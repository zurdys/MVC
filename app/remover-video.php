<?php

use App\Repository\VideoRepository;

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$repository = new VideoRepository($pdo);
$repository->remove($_GET['id']);

header("location: /");
