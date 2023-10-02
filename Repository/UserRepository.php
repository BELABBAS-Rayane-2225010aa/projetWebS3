<?php

use Model\User;

session_start();
class UserRepository extends AbstractRepository
{
    public function login(string $pseudo , string $password) : User
    {
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and PASSWORD = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $password]);
       if ( $statement -> rowCount() === 0 ){
                throw new NotFoundException("USER not Found");
       }

       $user = $statement->fetch();
       return new \Model\User(
           $user['PASSWORD'],
           $user['IMGPATH'],
           $user['PSEUDO'],
           $user['EMAIL'],
           $user['DATEFIRSTCO'],
           $user['DATELASTCO']
       );
    }
}