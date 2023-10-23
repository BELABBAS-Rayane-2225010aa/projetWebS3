<?php

namespace App\Controller;

class SetSession
{
    public function setUserSession($user) : void {
        unset($_SESSION['suid']);
        unset($_SESSION['user']);
        $_SESSION['suid'] = session_id();
        $_SESSION['user'] = $user;
    }
}