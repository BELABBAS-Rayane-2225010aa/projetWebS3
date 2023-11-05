<?php
/**
 * Connexion avec la BD
 *
 * Cette class permet de faire le lien avec la BD
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Repository
 *
 * @see \PDO
 *
 * @version 1.0
 */

namespace App\Repository;

use PDO;

/**
 * Cette class permet de réaliser l' action : getInstance
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 */
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