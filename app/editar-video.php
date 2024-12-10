<?php

use App\Entity\Video;
use App\Repository\VideoRepository;

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === FALSE || $id === null) {
    header("Location: /?sucesso=0");
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false || $id === null) {
    header('Location: /?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_EMAIL);
if ($titulo === false || $id === null) {
    header('Location: /?sucesso=0');
    exit();
}

$video = new Video($url, $titulo);
$video->setId($id);

$repository = new VideoRepository($pdo);
$repository->update($video);

header("Location: /");
