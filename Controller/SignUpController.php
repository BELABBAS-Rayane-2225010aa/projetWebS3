<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Repository\UserRepository;
use App\Exception\{
    CannotCreateUserException,
    EmailVerificationException,
    PasswordVerificationException,
    NotFoundException
};

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
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $email1 = $_POST['email1'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];

        $date = date("Y-m-d H:i:s");
        try{
            $user = new UserRepository();
            $signup = $user->signUp($password,$password1,$pseudo,$email,$email1,$date,$date);
            $newUser = new LoginController();
            $newUser->getLogin();
        }
        catch (CannotCreateUserException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (EmailVerificationException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (PasswordVerificationException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}