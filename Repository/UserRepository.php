<?php

namespace App\Repository;

require 'vendor/autoload.php';

use App\Exception\{
    CannotCreateUserException,
    EmailVerificationException,
    NotFoundException,
    PasswordVerificationException
};

use App\Model\User;

class UserRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(string $pseudo , string $password) : User
    {
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and MDP = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $password]);
       if ( $statement -> rowCount() === 0 ){
           throw new NotFoundException("USER not Found");
       }

       $user = $statement->fetch();
       return User::loginUser($user['MDP'], $user['PSEUDO']);
    }

    public function signUp(string $password, string $password1, string $imgPath,string $pseudo,
                           string $email, string $email1, string $dateFirstCo, string $dateLastCo): User {
        if ($email != $email1){
            throw new EmailVerificationException("Not the same email");
        }
        if ($password != $password1){
            throw new PasswordVerificationException("Not the same password");
        }
        $query = 'INSERT INTO USER (MDP, IMAGE, PSEUDO, MAIL, DATE_PREM, DATE_DER,ISADMIN) VALUES (:password, :imgPath, :pseudo, :email, :dateFirstCo, :dateLastCo,1)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['password' => $password, 'imgPath' => $imgPath, 'pseudo'=> $pseudo,
            'email' => $email, 'dateFirstCo' => $dateFirstCo, 'dateLastCo' => $dateLastCo]);
        if ( $statement -> rowCount() === 0){
            throw new CannotCreateUserException("USER cannot be created");
        }
        return $this->login($pseudo,$password);
    }

}