<?php

$pdo = new PDO("mysql:host=mariadb;dbname=banquinho", "root", "Psswd#123");
$pdo->exec('CREATE TABLE videos (id SERIAL PRIMARY KEY , url TEXT, title TEXT);');
