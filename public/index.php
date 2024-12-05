<?php

require '../vendor/autoload.php';

use App\Infrastructure\Repository\PdoStudentRepository;
use App\Modelos\Student;

$student = new Student (
    null,
    'Jorginho',
    new \DateTimeImmutable('1997-10-15')
);

//echo $student->age();
$repository = new PdoStudentRepository();
//print_r($teste->allStudents());
$repository->remove($student);

//$student = $repository->find(4);

//if ($student instanceof Student) {
//    $repository->remove($student);
//}

