<?php

namespace Controller;

class LoginController
{
    public function getlogin() : \Model\User {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['mdp'];
        try {
            return (new \UserRepository)->login($pseudo , $password);
        }
        //TODO : faire en sorte de renvoyé sur la page de SignUp en mettant un msg sur le problème
        catch (\Exception\NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log',
                $ERROR->getMessage()."\n".
                'Erreur du type : '. \UserRepository::$statement->errorCode() . json_encode(\UserRepository::$statement->errorInfo(). "\n".
                    'Sur la requête : '.\UserRepository::$query ),FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}