<?php
/**
 * Model représentant les Category
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\[NomDeRepositoryPlaceHolder]
 * @see \App\Controller\[NomDeControllerPlaceHolder]
 *
 * @version 1.0
 */

namespace App\Model;

/**
 * La classe Category permet de gérer les Catégories du forum
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class Category
{
    /**
     * Le contructeur de la class Category
     *
     * @param int $catID => id de la catégorie
     * @param string $label => label de la Category
     * @param string $description => description de la Category
     *
     * @return void
     */
    public function __construct(private int $catID, private string $label,private string $description){
    }

    /**
     * getter de l'attribut catID
     *
     * @return int
     */
    public function getCatID(): int
    {
        return $this->catID;
    }

    /**
     * getter de l'attribut label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * getter de l'attribut description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}