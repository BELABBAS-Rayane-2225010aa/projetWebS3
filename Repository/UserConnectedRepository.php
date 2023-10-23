<?php

namespace App\Repository;

use App\Exception\CannotInsertConnectedException;
use App\Model\User;

class UserConnectedRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function logIn(User $user) : string {
        $userId = $user->getUserId();

        $query = 'INSERT INTO USERCONNECTED (USER_ID) VALUES (:userId)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['userId' => $userId]);

        if ( $statement -> rowCount() === 0){
            throw new CannotInsertConnectedException("USER : ".$user->getPseudo()." cannot be connected");
        }

        return $user->getPseudo() ." is connected";
    }
}