<?php
require '../vendor/autoload.php';

use App\Infrastructure\Persistence\ConnectionCreator;
use App\Modelos\Student;

$pdo = ConnectionCreator::createConnection();

$student = new Student(
    null,
    "Vinicius', ''); DROP TABLE students; -- Dias",
    new \DateTimeImmutable('1997-10-15')
);

$sqlInsert = "INSERT INTO students(name, birth_date) VALUES (:name, :birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluído";
}
//var_dump($pdo->exec($sqlInsert));
