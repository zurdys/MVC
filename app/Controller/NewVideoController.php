<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('location: /');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('location: /');
            return;
        }

        $this->videoRepository->add(new Video($url, $titulo));
        header('location: /');
    }
}
