<?php

require '../vendor/autoload.php';

use App\Infrastructure\Persistence\ConnectionCreator;
use App\Infrastructure\Repository\PdoStudentRepository;
use App\Modelos\Student;

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);
$studentList = $repository->allStudents();

var_dump($studentList);



//while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
//    $student = new Student(
//        $studentData['id'],
//        $studentData['name'],
//        new \DateTimeImmutable($studentData['birth_date'])
//    );
//
//    echo $student->age() . PHP_EOL;
//}
//exit();
//
//var_dump($statement->fetchColumn(1)); exit();