<?php

namespace App\Controller;
use App\Exception\NotFoundException;
use App\Repository\BilletRepository;

require '../vendor/autoload.php';
class HeaderMenuController
{
    public function SearchBillet() : void
    {
        $recherche = $_POST['recherche'];

        try {
            $billet = new BilletRepository();
            $search = $billet->searchBillet($recherche);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}