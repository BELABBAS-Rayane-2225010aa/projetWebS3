<?php

namespace App\Controller;

use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

class ProfilController
{
    private array $billetArray;
    public function BilletArray() : void {
        $authorId = $_SESSION['user']->getUserId();
        try {
            $repo = new BilletRepository();
            $this->billetArray = $repo->getBilletArrayByAuthor($authorId);
        }
        catch(CannotFindBilletException $ERROR){
            $this->billetArray = [];
        }
    }

    public function getBilletArray() : array{
        return $this->billetArray;
    }
}