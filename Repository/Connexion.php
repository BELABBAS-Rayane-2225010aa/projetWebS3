<?php

namespace App\Repository;

class Connexion
{
    private static ?PDO $instance;

    public static function getInstance(): PDO
    {
        if (self::$instance == null) {

            self::$instance = new \PDO(
                getenv('DB_DND_DSN'),
                getenv('DB_DND_USER'),
                getenv('DB_DND_PASSWORD')
            );
        }
        return self::$instance;
    }
}
?>