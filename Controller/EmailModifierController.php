<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotModify;
use App\Exception\EmailVerificationException;
use App\Repository\UserRepository;

class EmailModifierController
{
    public function ModifEmail() : void
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
            $msg = "Email successfully modified";
            file_put_contents('Log/tavernDeBill.log',$msg."\n",FILE_APPEND | LOCK_EX);
        }
        catch (EmailVerificationException|CannotModify $ERROR){
            $msg = $ERROR->getMessage();
            file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        }

        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}