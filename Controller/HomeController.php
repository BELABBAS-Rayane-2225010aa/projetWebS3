<?php
/**
 * Controller de la page Home.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page Home
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\BilletRepository
 * @see \App\Repository\UserConnectedRepository
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\BilletRepository;
use App\Repository\UserConnectedRepository;

/**
 * Cette class permet de réaliser les actions : get5billet / getBilletArray / getConnected / getConnectedArray
 */
class HomeController
{
    private array $billetArray;
    private array $connectedArray;

    /**
     * permet de set un array des 5 dernier Billets : $billetArray
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function get5Billet() : void
    {
        try {
            $Billet = new BilletRepository();
            $this->billetArray = $Billet->get5Billet();
        }

        //on catch si on ne trouve pas de billet et on met un msg dans le log
        catch (NotFoundException $ERROR){
            file_put_contents('../Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    /**
     * permet de get l'array des 5 dernier Billet : $billetArray
     *
     * @return array
     */
    public function getBilletArray() : array {
        return $this->billetArray;
    }

    /**
     * permet de set un array des User connectés : $connectedArray
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getConnected() : void {
        try {
            $connected = new UserConnectedRepository();
            $this->connectedArray = $connected->getLogIn();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('../Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    /**
     * permet de get l'array des User connectés : $connectedArray
     *
     * @return array
     */
    public function getConnectedArray() : array {
        return $this->connectedArray;
    }
}