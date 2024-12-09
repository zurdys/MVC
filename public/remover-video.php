<?php

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");

$id = $_GET["id"];
$sql = "DELETE FROM videos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id);

if ($stmt->execute() === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
