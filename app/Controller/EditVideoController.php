<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Entity\Video;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, "url", FILTER_VALIDATE_URL);
        $titulo = filter_input(INPUT_POST, "titulo");

        $video = new Video($url, $titulo);
        $video->setId($id);

        $this->videoRepository->update($video);
        header('Location: /');
    }
}