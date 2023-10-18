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
 * @version 0.9
 *
 * @todo : vérifier quand le site est en ligne que la connexion est effective (si c'est bon passer en @version 1.0)
 */

namespace App\Repository;
use PDO;

abstract class AbstractRepository
{
    protected PDO $connexion ;

    /**
     * Ce constructeur permet de mettre en place les variables d'environnement pour nous connecter ensuite à la BD
     */
    public function __construct()
    {
        putenv("DB_DND_DSN=mysql:host=mysql-rbb.alwaysdata.net;dbname=rbb_sitednd");
        putenv("DB_DND_USER=rbb");
        putenv("DB_DND_PASSWORD=RayaneBD20");
        $this->connexion = Connexion::getInstance();
    }
}