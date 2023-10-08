<?php

namespace Controller;

use Exception\EmailVerificationException;
use Exception\PasswordVerificationException;

class SignUpController
{
    public function getSignUp() : \Model\User {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $email1 = $_POST['email1'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $imgPath = $_POST['imgPath'];
        try{
            return (new \UserRepository)->signUp($password,$password1,$imgPath,$pseudo,$email,$email1);
        }
        catch (){
            exit();
        }
    }
}