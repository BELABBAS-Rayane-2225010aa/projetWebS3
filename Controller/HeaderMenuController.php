<?php
/**
 * Controller de la page HeaderMenu.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page HeaderMenu
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\CategoryRepository
 *
 * @version 1.0
 */

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\CategoryRepository;

/**
 * Cette class permet de réaliser les actions : getAllCat / getCatArray
 */
class HeaderMenuController
{
    private array $catArray = [];

    /**
     * permet de set un array de Category $catArray
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function getAllCat() : void
    {
        try {
            $cat = new CategoryRepository();
            $this->catArray = $cat->getCategorieInstance();
        }

        //on catch si on ne trouve pas de Category et on rend une erreur dans le log
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
        }
    }

    /**
     * permet de get l'array de Category $catArray
     *
     * @return array
     */
    public function getCatArray() : array{
        return $this->catArray;
    }

}