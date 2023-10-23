<?php
/**
 * Connexion avec la BD
 *
 * Cette class permet de faire le lien avec la BD
 *
 * @author Belabbas Rayane / Crespin Alexandre
 *
 * @see \App\Repository\AbstractRepository
 *
 * @version 0.9
 *
 * @todo : vérifier quand le site est en ligne que la connexion est effective (si c'est bon passer en @version 1.0)
 */

namespace App\Repository;

use PDO;

class Connexion
{
    private static ?PDO $instance = null;

    /**
     * Connexion à la BD
     *
     * Cette fonction permet de récupérer les variable d'environnement décrite dans AbstractRepository
     * et de faire la connexion via PDO
     *
     * @return PDO => l'instance de connexion à notre BD
     */
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