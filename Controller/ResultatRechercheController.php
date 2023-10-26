<?php

namespace App\Controller;
use App\Exception\NotFoundException;
use App\Repository\BilletRepository;

require '../vendor/autoload.php';
class ResultatRechercheController
{
    private array $billetArray;
    public function getSearchBillet() : void
    {
        $recherche = $_POST['TexteRecherche'];


        try {
            $billet = new BilletRepository();
            $this->billetArray = $billet->searchBillet($recherche);
            var_dump('hola');

        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function getSearchedBilletArray() : array {
        return $this->billetArray;
    }
}