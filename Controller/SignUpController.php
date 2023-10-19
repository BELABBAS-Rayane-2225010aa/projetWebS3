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
        }
        catch (CannotCreateUserException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (EmailVerificationException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (PasswordVerificationException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}