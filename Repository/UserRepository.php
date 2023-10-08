<?php

use Exception\CannotCreateUserException;
use Exception\EmailVerificationException;
use Exception\NotFoundException;
use Exception\PasswordVerificationException;
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

    public function signUp(string $password, string $password1, string $imgPath,string $pseudo,
                           string $email, string $email1, string $dateFirstCo, string $dateLastCo): User {
        if ($email != $email1){
            throw new EmailVerificationException("Not the same email");
        }
        if ($password != $password1){
            throw new PasswordVerificationException("Not the same password");
        }
        $query = 'INSERT INTO USER VALUES (:password, :imgPath, :pseudo, :email, :dateFirstCo, :dateLastCo)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['password' => $password, 'imgPath' => $imgPath, 'pseudo'=> $pseudo,
            'email' => $email, 'dateFirstCo' => $dateFirstCo, 'dateLastCo' => $dateLastCo]);
        if ( $statement -> rowCount() === 0){
            throw new CannotCreateUserException("USER cannot be created");
        }
        $user = $this->login($pseudo,$password);
        return $user;
    }
}