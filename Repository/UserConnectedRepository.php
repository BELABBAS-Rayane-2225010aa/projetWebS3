<?php
/**
 * La classe UserConnectedRepository permet de gérer les requête SQL relatifs aux utilisateurs connecter
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 *
 * @see \App\Model\User
 *
 * @package App\Repository
 *
 * @version 1.0
 */

namespace App\Repository;

use App\Exception\CannotDeleteConnectedException;
use App\Model\User;

/**
 * Cette class permet de réaliser les actions : logIn / logOut / getLogIn
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class UserConnectedRepository extends AbstractRepository
{
    /**
     * Le constructeur de la classe UserConnectedRepository
     *
     * on appelle le constructeur de la class parent AbstractRepository
     * pour récupérer la connexion à la BD
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction de logIn
     *
     * Cette fonction permet de modifier en est connecter un User
     *
     * @param User $user => Le User
     *
     * @return string => un message envoyé dans le fichier log
     */
    public function logIn(User $user) : string {
        $userId = $user->getUserId();
        date_default_timezone_set("Europe/Paris");
        $dateDerCo = date("Y-m-d H:i:s");

        //On update le statut de connexion de l'utilisateurs
        $query = 'UPDATE USER SET ISCONNECTED = 1, DATE_DER = :dateDerCo WHERE USER_ID = :userId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['dateDerCo' => $dateDerCo,'userId' => $userId]);

        return $user->getPseudo() ." is connected";
    }

    /**
     * Fonction de logOut
     *
     * Cette fonction permet de modifier en non connecter un User
     *
     * @param User $user => Le User
     *
     * @throws CannotDeleteConnectedException
     *
     * @return string => un message envoyé dans le fichier log
     */
    public function logOut(User $user) : string {
        $userId = $user->getUserId();

        //On update le statut de connexion de l'utilisateurs
        $query = 'UPDATE USER SET ISCONNECTED = 0 WHERE USER_ID = :userId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['userId' => $userId]);

        //Si la requête ne renvoie rien ça veut dire que l'utilisateur est déja déconnecter
        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteConnectedException("USER : ".$user->getPseudo()." cannot be deconnected");
        }

        return $user->getPseudo() ." is deconnected";
    }

    /**
     * Fonction getLogin
     *
     * Cette fonction permet de mettre dans une liste tout les utilisateur connectés
     *
     * @return array
     */
    public function getLogIn() : array {
        //On select tout les User qui sont connecté
        $query = 'SELECT * FROM USER WHERE ISCONNECTED = 1';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();

        $arraySQL =  $statement->fetchAll();
        $arrayLogIn = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de User*/
        for ($i = 0; $i < sizeof($arraySQL);$i++){
            $connected = new User($arraySQL[$i]['USER_ID'],$arraySQL[$i]['MDP'],$arraySQL[$i]["PSEUDO"],$arraySQL[$i]['MAIL'],$arraySQL[$i]['DATE_PREM'],$arraySQL[$i]['DATE_DER'],$arraySQL[$i]['ISADMIN']);
            $arrayLogIn[] = $connected;
        }

        return $arrayLogIn;
    }
}