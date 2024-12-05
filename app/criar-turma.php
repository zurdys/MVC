<?php

require_once '../vendor/autoload.php';

use App\Infrastructure\Persistence\ConnectionCreator;
use App\Infrastructure\Repository\PdoStudentRepository;
use App\Modelos\Student;

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

// realizo processos de definição da turma

// inserir os alunos da turma

$connection->beginTransaction();

try{
    $aStudent = new Student(
        null,
        'Nico Steppat',
        new DateTimeImmutable('1985-05-21')
    );
    $studentRepository->save($aStudent);

    $anotherStudent = new Student(
        null,
        'Jorge Henrique',
        new DateTimeImmutable('1999-09-03')
    );
    $studentRepository->save($anotherStudent);
    $connection->commit();
} catch (\PDOException $e) {
    echo $e->getMessage();
    $connection->rollBack();
}

