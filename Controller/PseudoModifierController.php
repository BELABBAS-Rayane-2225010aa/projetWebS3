<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotModify;
use App\Exception\PasswordVerificationException;
use App\Exception\PseudoVerificationException;
use App\Repository\UserRepository;
use http\Client\Curl\User;

class PseudoModifierController
{
    public function ModifPseudo() : \App\Model\User
    {
        $oldPseudo = $_POST['oldPseudo'];
        $newPseudo = $_POST['newPseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
            $login = $user->pseudoModifier($oldPseudo,$newPseudo,$password);
            $session = new SetSession();
            $session->setSession($login);
        }
        catch (PseudoVerificationException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (CannotModify $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        return $login;
    }
}