<?php

namespace App\Controller;

use App\Exception\CannotCreateBilletException;
use App\Exception\NotFoundException;
use App\Model\Billet;
use App\Repository\BilletRepository;
use App\Model\User;
use App\Repository\UserRepository;

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
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getNewBillet() : void {
        $title = $_POST['title'];
        $msg = $_POST['msg'];
        $authorID = $_POST['authorID'];
        $categoryId = $_POST['category'];
        date_default_timezone_set("Europe/Paris");
        $dateBillet = date("Y-m-d H:i:s");
        try{
            $billet = new BilletRepository();
            $billet->createBillet($title,$msg,$dateBillet,$authorID,$categoryId);
        }
        catch (CannotCreateBilletException $ERROR){
            file_put_contents('../Log/tavernDeBill.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getBillet() : Billet{
        return $this->billet;
    }

    public function getPseudoFromAuteurID() : void{
        $authorID = $_POST['authorID'];
        try{
            $billet = new UserRepository();
            $billet->getPseudoFromID($authorID);
        }
        catch (NotFoundException $e){
            file_put_contents('../Log/tavernDeBill.log',$e->getMessage()."\n",FILE_APPEND | LOCK_EX);
        }
    }
}