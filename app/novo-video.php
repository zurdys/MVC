<?php

use App\Entity\Video;
use App\Repository\VideoRepository;

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}

$repository = new VideoRepository($pdo);
$video = new Video($_POST['url'], $_POST['titulo']);
$repository->add($video);

header('Location: /');
