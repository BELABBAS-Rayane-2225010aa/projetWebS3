<?php
/**
 * Controller de la page ResultatRecherche.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page ResultatRecherche
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\UserRepository
 * @see \App\Repository\BilletRepository
 * @see \App\Repository\CategoryRepository
 * @see \App\Repository\CommentRepository
 *
 * @version 0.9
 *
 * @todo : degager ces echo ou trouvé un meilleur moyen d'utilisé ces exceptions
 */

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\BilletRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;

/**
 * Cette class permet de réaliser l'action : getSearchBillet / getSearchedBilletArray / getSearchComment /
 * getSearchedCommentArray / getSearchCat / getSearchedCatArray / getSearchUser / getSearchedUserArray
 */
class ResultatRechercheController
{
    private array $billetArray = [];
    private array $commentArray = [];
    private array $catArray = [];
    private array $userArray = [];

    /**
     * permet de set l'array des Billet rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getSearchBillet() : void
    {
        //on récupère les données du formulaire
        $recherche = $_POST['TexteRecherche'];

        try {
            $billet = new BilletRepository();
            $this->billetArray = $billet->searchBillet($recherche);
        }

        //on catch si on ne trouve rien
        catch (NotFoundException $ERROR){
            echo $ERROR->getMessage();

        }
    }

    /**
     * permet de get l'array des Billet rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return array
     */
    public function getSearchedBilletArray() : array{

        return $this->billetArray;
    }

    /**
     * permet de set l'array des Comment rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getSearchComment() : void
    {
        //on récupère les données du formulaire
        $recherche = $_POST['TexteRecherche'];

        try {
            $comment = new CommentRepository();
            $this->commentArray = $comment->searchComment($recherche);
        }

        //on catch si on ne trouve rien
        catch (NotFoundException $ERROR){
            echo $ERROR->getMessage();
        }
    }

    /**
     * permet de get l'array des Comment rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return array
     */
    public function getSearchedCommentArray() : array{
        return $this->commentArray;
    }

    /**
     * permet de set l'array des Category rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getSearchCat() : void
    {
        //on récupère les données du formulaire
        $recherche = $_POST['TexteRecherche'];

        try {
            $cat = new CategoryRepository();
            $this->catArray = $cat->searchCat($recherche);
        }

        //on catch si on ne trouve rien
        catch (NotFoundException $ERROR){
            echo $ERROR->getMessage();
        }
    }

    /**
     * permet de get l'array des Category rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return array
     */
    public function getSearchedCatArray() : array{
        return $this->catArray;
    }

    /**
     * permet de set l'array des User rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getSearchUser() : void
    {
        //on récupère les données du formulaire
        $recherche = $_POST['TexteRecherche'];

        try {
            $user = new UserRepository();
            $this->userArray = $user->searchUser($recherche);
        }

        //on catch si on ne trouve rien
        catch (NotFoundException $ERROR){
            echo $ERROR->getMessage();
        }
    }

    /**
     * permet de get l'array des User rechercher dans la barre de recherche
     *
     * @catch NotFoundException
     *
     * @return array
     */
    public function getSearchedUserArray() : array
    {
        return $this->userArray;
    }
}

