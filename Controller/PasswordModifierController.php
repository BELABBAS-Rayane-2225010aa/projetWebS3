<?php

namespace App\Controller;

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
            $user->passwordModifier($oldPassword,$newPassword,$newPassword1);
        }
        catch (PasswordVerificationException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
        catch (CannotModify $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}