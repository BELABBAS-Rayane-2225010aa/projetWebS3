<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Model\User;
use App\Repository\UserRepository;
use App\Exception\NotFoundException;

class LoginController
{

    /**
     * récupère le USER renvoyer par la fonction login
     * et permet à l'utilisateur de se connecter
     *
     * @catch NotFoundException
     *
     * @return void génère un identifiant de session unique pour l'utilisateur actuel
     * et stocke cet objet dans une variable de session appelée 'user'.
     */
    public function getLogin(): void
    {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
            $login = $user->login($pseudo , $password);
            if ($pseudo === $login->getPseudo() && $password === $login->getPassword() ){
                $session = new SetSession();
                $session->setSession($login);
            }
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}