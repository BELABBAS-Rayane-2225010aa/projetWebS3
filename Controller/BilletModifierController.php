<?php

namespace App\Controller;

use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

class BilletModifierController
{
    private array $billetArray;
    public function BilletArrayPrivate() : void {
        $authorId = $_SESSION['user']->getUserId();
        try {
            $repo = new BilletRepository();
            $this->billetArray = $repo->getBilletArrayByAuthor($authorId);
        }
        catch(CannotFindBilletException $ERROR){
            $this->billetArray = [];
        }
    }

    public function BilletArrayPublic() : void {
        if (isset($_POST['userClique'])){
            $serializedUser = $_POST['userClique'];
            $userClique = unserialize(base64_decode($serializedUser));
            $authorId = $userClique->getUserId();
        }

        //ATTENTION ceci est a mesure de test
        else {
            $authorId = 1;
        }

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