<?php

namespace App\Controller;


use App\Exception\CannotModify;
use App\Exception\PasswordVerificationException;
use App\Repository\UserRepository;

class PasswordModifierController
{
    public function ModifPassword() : void
    {
        $oldPassword = md5($_POST['oldPassword']);
        $newPassword = md5($_POST['newPassword']);
        $newPassword1 = md5($_POST['newPassword1']);
        try {
            $user = new UserRepository();
            $msg = $user->passwordModifier($oldPassword,$newPassword,$newPassword1);
        }
        catch (PasswordVerificationException | CannotModify $ERROR){
            $msg = $ERROR->getMessage();
        }

        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
    }
}