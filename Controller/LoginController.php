<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Model\User;
use App\Repository\UserRepository;
use App\Exception\NotFoundException;

class LoginController
{


    public function __construct()
    {
    }

    public function getLogin(): void
    {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
            $login = $user->login($pseudo , $password);
            if ($pseudo === $login->getPseudo() && $password === $login->getPassword() ){
                $_SESSION['suid'] = session_id();
                $_SESSION['user'] = $login;
            }
        }
        catch (NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}