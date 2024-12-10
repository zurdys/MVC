<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $videoList = $this->videoRepository->all();
        require __DIR__ . '/../views/video-list.php';
    }
}
