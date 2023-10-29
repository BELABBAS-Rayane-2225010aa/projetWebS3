<?php

namespace App\Controller;

use App\Repository\UserConnectedRepository;
use App\Repository\UserRepository;
use App\Exception\{CannotCreateUserException, EmptyFieldException, PasswordVerificationException};

class SignUpController
{

    /**
     * Cette fonction ce sert de la fonction signUp pour créer l'utilisateur
     *
     * @catch CannotCreateUserException
     * @catch EmailVerificationException
     * @catch PasswordVerificationException
     * @catch NotFoundException
     *
     * @return void génère un identifiant de session unique pour l'utilisateur actuel
     * et stocke cet objet dans une variable de session appelée 'user'.
     */
    public function getSignUp() : void {
        //on recupère les information rentrer dans la formulaire par le User
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);
        $date = date("Y-m-d H:i:s");

        try{
            //on créer et récupère le User qui correspond dans la BD
            $user = new UserRepository();
            $signup = $user->signUp($password,$password1,$pseudo,$email,$date,$date);

            //on update ISCONNECTED dans la BD
            $connected = new UserConnectedRepository();
            file_put_contents('Log/tavernDeBill.log', $connected->logIn($signup),FILE_APPEND | LOCK_EX);

            //on set la session
            $session = new SetSession();
            $session->setUserSession($signup);
        }
        //on catch si un champ de saisie est vide ou si on ne peut pas créer l'utilisateurs ou si les password données ne sont pas les même
        catch (EmptyFieldException | CannotCreateUserException | PasswordVerificationException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on fais un retour d'erreur ou de réussite
        file_put_contents('Log/tavernDeBill.log',$msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}