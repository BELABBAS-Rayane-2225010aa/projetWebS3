<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotModify;
use App\Exception\PseudoVerificationException;
use App\Repository\UserRepository;

class PseudoModifierController
{
    public function ModifPseudo() : void
    {
        $oldPseudo = $_POST['oldPseudo'];
        $newPseudo = $_POST['newPseudo'];
        $password = $_POST['password'];
        try {
            $user = new UserRepository();
            $login = $user->pseudoModifier($oldPseudo,$newPseudo,$password);
            $session = new SetSession();
            $session->setUserSession($login);
            $msg = "Pseudo successfully modified";
            file_put_contents('Log/tavernDeBill.log',$msg."\n",FILE_APPEND | LOCK_EX);
        }
        catch (PseudoVerificationException|CannotModify $ERROR){
            $msg = $ERROR->getMessage();
            file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        }

        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}