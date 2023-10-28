<?php

namespace App\Repository;

use App\Exception\CannotDeleteConnectedException;
use App\Model\User;

class UserConnectedRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function logIn(User $user) : string {
        $userId = $user->getUserId();

        $query = 'UPDATE USER SET ISCONNECTED = 1 WHERE USER_ID = :userId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['userId' => $userId]);

        return $user->getPseudo() ." is connected";
    }

    public function logOut(User $user) : string {
        $userId = $user->getUserId();

        $query = 'UPDATE USER SET ISCONNECTED = 0 WHERE USER_ID = :userId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['userId' => $userId]);

        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteConnectedException("USER : ".$user->getPseudo()." cannot be deconnected");
        }

        return $user->getPseudo() ." is deconnected";
    }

    public function getLogIn() : array {
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