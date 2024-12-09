<?php

declare(strict_types=1);

var_dump($_SERVER);

if ($_SERVER['REQUEST_URI'] === '/editar-video'){
    require_once "listagem-videos.php";
}

// Checar o html e css do arquivo que foi implementado o inicio e fim html