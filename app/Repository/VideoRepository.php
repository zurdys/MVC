<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Video;

class VideoRepository
{
    public function __construct(private \pdo $pdo)
    {
    }

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (?, ?);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();

        $video ->setId(intval($id));

        return $result;
    }

    public function remove(int $id): bool
    {
        $id = $_GET["id"];
        $sql = "DELETE FROM videos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function update(Video $video): bool
    {
        $sql = "UPDATE videos SET url = ?, title = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);
        $stmt->bindValue(3, $video->id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateVideo($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);

        return $video;
    }
}
