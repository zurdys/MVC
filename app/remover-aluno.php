<?php

require '../vendor/autoload.php';

use App\Infrastructure\Persistence\ConnectionCreator;
use App\Modelos\Student;

$pdo = ConnectionCreator::createConnection();

$preparedStatement = $pdo->prepare('DELETE FROM students WHERE id = ?;');
$preparedStatement->bindValue(1, 3, PDO::PARAM_INT);
var_dump($preparedStatement->execute());
