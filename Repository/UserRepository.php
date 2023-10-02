<?php

use Model\User;

session_start();
class UserRepository extends AbstractRepository
{
    public function login(string $pseudo , string $mdp) : User
    {
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and MDP = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $mdp]);
       if ( $statement -> rowCount() === 0 ){
                throw new NotFoundException("USER not Found");
       }

       $user = $statement->fetch();
       return new \Model\User(
           $user['PSEUDO']
       );
    }

}