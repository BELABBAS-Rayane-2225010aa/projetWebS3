<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\BilletRepository;

class CategoryController
{
    private array $billetArray = [];


    public function getBilletByCat() : void
    {
        $cat = $_POST['catClique'];
        $unCat = unserialize(base64_decode($cat));
        try {
            $billet = new BilletRepository();
            $this->billetArray = $billet->arrayBilletByCatID($unCat->getCatId());
        }

            //on catch si on ne trouve rien
        catch (NotFoundException $ERROR){
            echo $ERROR->getMessage();


        }
    }
    public function getBilletByCatArray() : array{

        return $this->billetArray;
    }
}