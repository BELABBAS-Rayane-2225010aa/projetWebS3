<?php

namespace App\Controller;

use App\Exception\CannotCreateBilletException;
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
            file_put_contents('[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getNewBillet() : void {
        $title = $_POST['title'];
        $msg = $_POST['msg'];
        $authorId = $_POST['authorId'];
        $categoryId = $_POST['categoryId'];

        try{
            $billet = new BilletRepository();
            $billet->createBillet($title,$msg,$authorId,$categoryId);
        }
        catch (CannotCreateBilletException $ERROR){
            file_put_contents('[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBillet() : Billet{
        return $this->billet;
    }
}