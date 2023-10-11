<?php

namespace App\Controller;

require 'vendor\autoload.php';

use App\Repository\UserRepository;
use App\Exception\NotFoundException;

class LoginController
{


    public function __construct()
    {
    }

    public function getLogin(): void
    {
        var_dump('coucou');
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
             $login = $user->login($pseudo , $password);
             if ($pseudo === $login->getPseudo() && $pseudo === $login->getPassword() ){
                $_SESSION['suid'] = session_id();
                echo 'coucou';
                header('Location: http://localhost:8080/View/Page/Bonjour.php');
                exit() ;
             }

        }
        //TODO : faire en sorte de renvoyé sur la page de SignUp en mettant un msg sur le problème
        catch (NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}