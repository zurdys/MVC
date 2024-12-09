<?php

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === FALSE) {
    header("Location: /?sucesso=0");
    exit();
}

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

$sql = "UPDATE videos SET url = ?, title = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $titulo);
$stmt->bindValue(3, $id, PDO::PARAM_INT);

if ($stmt->execute() === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
