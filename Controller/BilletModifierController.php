<?php

namespace App\Controller;

use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

class BilletModifierController
{
    public function updateBillet(): void {
        $oldTitle = $_POST['oldTitle'];
        $title = $_POST['title'];
        $msg = $_POST['desc'];
        $dateBillet = date("Y-m-d H:i:s");
        $authorId = $_POST['authorID'];
        $categoryId = $_POST['category'];
        try{
            $billet = new BilletRepository();
            $billet->updateBillet($oldTitle,$title,$msg,$dateBillet,$authorId,$categoryId);
        }
        catch(CannotFindBilletException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
        }
    }
}