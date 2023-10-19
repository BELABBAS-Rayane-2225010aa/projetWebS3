<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotModify;
use App\Exception\EmailVerificationException;
use App\Exception\PasswordVerificationException;
use App\Exception\PseudoVerificationException;
use App\Repository\UserRepository;
use http\Client\Curl\User;

class EmailModifierController
{
    public function ModifPseudo() : \App\Model\User
    {
        $oldEmail = $_POST['oldEmail'];
        $newEmail = $_POST['newEmail'];
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
            $login = $user->emailModifier($oldEmail,$newEmail,$pseudo,$password);
            $session = new SetSession();
            $session->setUserSession($login);
        }
        catch (EmailVerificationException $ERROR){
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