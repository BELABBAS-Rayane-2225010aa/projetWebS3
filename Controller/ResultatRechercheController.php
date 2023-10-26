<?php

namespace App\Controller;
use App\Exception\NotFoundException;
use App\Repository\BilletRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

class ResultatRechercheController
{
    private array $billetArray = [];
    private array $commentArray = [];
    private array $catArray = [];
    private array $userArray = [];
    public function getSearchBillet() : void
    {
        $recherche = $_POST['TexteRecherche'];


        try {
            $billet = new BilletRepository();
            $this->billetArray = $billet->searchBillet($recherche);
        }
        catch (NotFoundException $ERROR){
            echo 'Aucun billet trouvé pour: '.$recherche.'...';

        }
    }


    public function getSearchedBilletArray() : array{

        return $this->billetArray;
    }
    public function getSearchComment() : void
    {
        $recherche = $_POST['TexteRecherche'];


        try {
            $comment = new CommentRepository();
            $this->commentArray = $comment->searchComment($recherche);
        }
        catch (NotFoundException $ERROR){
            echo 'Aucun commentaire trouvé pour: '.$recherche.'...';
        }
    }

    public function getSearchedCommentArray() : array{
        return $this->commentArray;
    }

    public function getSearchCat() : void
    {
        $recherche = $_POST['TexteRecherche'];


        try {
            $cat = new CategoryRepository();
            $this->catArray = $cat->searchCat($recherche);
        }
        catch (NotFoundException $ERROR){
            echo 'Aucune catégorie trouvé pour: '.$recherche.'...';
        }
    }

    public function getSearchedCatArray() : array{
        return $this->catArray;
    }

    public function getSearchUser() : void
    {
        $recherche = $_POST['TexteRecherche'];


        try {
            $user = new UserRepository();
            $this->userArray = $user->searchUser($recherche);
        }
        catch (NotFoundException $ERROR){
            echo 'Aucun Utilisateur trouvé pour: '.$recherche.'...';
        }
    }

    public function getSearchedUserArray() : array
    {
        return $this->userArray;
    }
}

