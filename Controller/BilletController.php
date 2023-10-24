<?php

namespace App\Controller;

require 'vendor/autoload.php';

use App\Exception\CannotCreateBilletException;
use App\Exception\NotFoundException;
use App\Model\Billet;
use App\Repository\BilletRepository;
use App\Model\User;

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

    public function getNewBillet() : void {
        $title = $_POST['title'];
        $msg = $_POST['msg'];
        $authorId = 1;
        $categoryId = $_POST['category'];

        $dateBillet = date("Y-m-d H:i:s");
        try{
            $billet = new BilletRepository();
            $billet->createBillet($title,$msg,$dateBillet,$authorId,$categoryId);
        }
        catch (CannotCreateBilletException $ERROR){
            file_put_contents('../Log/[PlaceHolderName].log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBillet() : Billet{
        return $this->billet;
    }
}