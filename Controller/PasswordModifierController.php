<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotModify;
use App\Exception\PasswordVerificationException;
use App\Repository\UserRepository;

class PasswordModifierController
{
    public function ModifPassword() : void
    {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newPassword1 = $_POST['newPassword1'];
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
        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
    }
}