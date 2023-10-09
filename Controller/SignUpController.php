<?php

namespace Controller;

class SignUpController
{
    public function getSignUp() : \Model\User {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $email1 = $_POST['email1'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $imgPath = $_POST['imgPath'];

        $date = date("Y-m-d H:i:s");
        try{
            return (new \UserRepository)->signUp($password,$password1,$imgPath,$pseudo,$email,$email1,$date,$date);
        }
        //TODO : faire en sorte de renvoyé sur la page de SignUp en mettant un msg sur le problème
        catch (\Exception\CannotCreateUserException $ERROR){
            file_put_contents('[PlaceHolderName].log',
                $ERROR->getMessage()."\n".
                'Erreur du type : '. \UserRepository::$statement->errorCode() . json_encode(\UserRepository::$statement->errorInfo(). "\n".
                    'Sur la requête : '.\UserRepository::$query ),FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (\Exception\EmailVerificationException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage(),FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (\Exception\PasswordVerificationException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage(),FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}