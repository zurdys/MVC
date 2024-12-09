<?php

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_EMAIL);
if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?);';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_POST["url"]);
$stmt->bindValue(2, $_POST["titulo"]);
$stmt->execute();


header('Location: /?sucesso=1');
