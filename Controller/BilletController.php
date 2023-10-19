<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Billet;
use App\Repository\BilletRepository;

class BilletController
{
    private Billet $billet;

    public function showBillet() : void
    {
        $billet_id = $_GET['billet_id'];
        try {
            $billetRepo = new BilletRepository();
            $this->billet = $billetRepo->getBillet($billet_id);
        }
        catch(NotFoundException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBillet() : Billet{
        return $this->billet;
    }
}