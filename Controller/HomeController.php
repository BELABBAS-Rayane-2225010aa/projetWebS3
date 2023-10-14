<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\BilletRepository;

class HomeController
{
    private array $billetArray;
    public function get5Billet() : void
    {
        try {
            $Billet = new BilletRepository();
            $this->billetArray = $Billet->get5Billet();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBilletArray() : array {
        return $this->billetArray;
    }
}