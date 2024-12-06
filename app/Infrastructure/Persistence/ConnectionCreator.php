<?php

namespace App\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $databasePath = __DIR__ . '/../../banco.sqlite';
        $connection = new PDO(
            'mysql:host=172.17.0.2;dbname=banco',
            'root',
            'senhalura');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}