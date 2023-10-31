<?php
/**
 * Controller de la page Profil.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page Profil
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\BilletRepository
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;

use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

/**
 * Cette class permet de réaliser l'action : billetArrayPrivate / billetArrayPublic / getBilletArray
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class ProfilController
{
    private array $billetArray;

    /**
     * permet de récupérer les billet du User actif
     *
     * @catch CannotFindBilletException
     *
     * @return void
     */
    public function BilletArrayPrivate() : void {
        //on recupère l'id du User
        $authorId = $_SESSION['user']->getUserId();

        try {
            $repo = new BilletRepository();
            $this->billetArray = $repo->getBilletArrayByAuthor($authorId);
        }

        //on catch si on ne trouve pas de billet correspodant au User
        catch(CannotFindBilletException $ERROR){
            $this->billetArray = [];
        }
    }

    /**
     * permet de récupérer les billet de n'importe quel User demander
     *
     * @catch CannotFindBilletException
     *
     * @return void
     */
    public function BilletArrayPublic() : void {
        //on récupère l'id de l'utilisateur clique
        if (isset($_POST['userClique'])){
            $serializedUser = $_POST['userClique'];
            $userClique = unserialize(base64_decode($serializedUser));
            $authorId = $userClique->getUserId();
        }

        try {
            $repo = new BilletRepository();
            $this->billetArray = $repo->getBilletArrayByAuthor($authorId);
        }

        //on catch si on ne trouva pas de billet correspondant au User
        catch(CannotFindBilletException $ERROR){
            $this->billetArray = [];
        }
    }

    /**
     * permet de get l'array de billet correspondant à un User : $billetArray
     *
     * @return array
     */
    public function getBilletArray() : array{
        return $this->billetArray;
    }
}