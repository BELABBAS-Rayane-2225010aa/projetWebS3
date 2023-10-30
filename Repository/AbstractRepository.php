<?php
/**
 * Repository abstraite
 *
 * Cette class permet de mettre en place la connexions avec la base de donnée
 * Tous les autres Repository sont des enfant de cette class abstraite pour récupérer la connexion
 * Il doit avoir un Repository par class
 *
 * @author Belabbas Rayane / Crespin Alexandre
 *
 * @see \App\Repository\Connexion
 *
 * @version 1.0
 */

namespace App\Repository;
use PDO;

abstract class AbstractRepository
{
    protected PDO $connexion ;

    /**
     * @method PDO getInstance()
     *
     * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
     */
    public function __construct()
    {
        putenv("DB_DND_DSN=mysql:host=mysql-rbb.alwaysdata.net;dbname=rbb_sitednd");
        putenv("DB_DND_USER=rbb");
        putenv("DB_DND_PASSWORD=RayaneBD20");
        $this->connexion = Connexion::getInstance();
    }
}