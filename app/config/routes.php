<?php

use App\Controller\DeleteVideoController;
use App\Controller\EditVideoController;
use App\Controller\VideoFormController;
use App\Controller\VideoListController;

return [
    'GET|/'              => VideoListController::class,
    'GET|/novo-video'    => VideoFormController::class,
    'POST|/novo-video'   => VideoFormController::class,
    'GET|/editar-ivdeo'  => VideoFormController::class,
    'POST|/editar-ivdeo' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,
];