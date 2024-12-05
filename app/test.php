<?php

use App\Infrastructure\Repository\PdoStudentRepository;

$pdo = new PDO('mysql:');
$repository = new PdoStudentRepository($pdo);


