<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\BilletRepository;

class IndexController
{
    public function get5Billet() : void
    {
        try {
            $Billet = new BilletRepository();
            $cinqBillet = $Billet->get5Billet();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}