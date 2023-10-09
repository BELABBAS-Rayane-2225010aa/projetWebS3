<?php

namespace Controller;
require_once  '../Repository/UserRepository.php';


class LoginController
{


    public function __construct()
    {
    }

    public function getLogin()  {
        $pseudo = $_GET['pseudo'];
        $password = $_GET['mdp'];
        try {
            $user = new \UserRepository();
             $user->login($pseudo , $password);
             if ($pseudo === $user->getPseudo() && $pseudo === $user->getPassword() ){
                $_SESSION['suid'] = session_id();
                echo 'coucou';
                header('Location: http://localhost:8080/View/Page/Bonjour.php');
                exit() ;
             }

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