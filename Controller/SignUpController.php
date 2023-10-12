<?php

namespace App\Controller;

require 'vendor\autoload.php';

use App\Model\User;
use App\Repository\UserRepository;
use App\Exception\{
    CannotCreateUserException,
    EmailVerificationException,
    PasswordVerificationException,
    NotFoundException
};

class SignUpController
{
    public function getSignUp() : User {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $email1 = $_POST['email1'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $imgPath = $_POST['imgPath'];

        $date = date("Y-m-d H:i:s");
        try{
            return (new UserRepository)->signUp($password,$password1,$imgPath,$pseudo,$email,$email1,$date,$date);
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