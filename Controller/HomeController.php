<?php

namespace App\Controller;

require '../vendor/autoload.php';

use App\Exception\CannotFindConnectedException;
use App\Exception\NotFoundException;
use App\Repository\BilletRepository;
use App\Repository\UserConnectedRepository;

class HomeController
{
    private array $billetArray;
    private array $connectedArray;
    public function get5Billet() : void
    {
        try {
            $Billet = new BilletRepository();
            $this->billetArray = $Billet->get5Billet();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('../Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBilletArray() : array {
        return $this->billetArray;
    }

    public function getConnected() : void {
        try {
            $connected = new UserConnectedRepository();
            $this->connectedArray = $connected->getLogIn();
        }
        catch (CannotFindConnectedException $ERROR){
            file_put_contents('../Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getConnectedArray() : array {
        return $this->connectedArray;
    }
}