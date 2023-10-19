<?php

namespace App\Controller;

require 'vendor/autoload.php';
class SetSession
{
    public function setSession($user) : void {
        unset($_SESSION['suid']);
        unset($_SESSION['user']);
        $_SESSION['suid'] = session_id();
        $_SESSION['user'] = $user;
    }
}