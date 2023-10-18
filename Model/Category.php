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

class Category
{
    /**
     * Le contructeur de la class Category
     *
     * @param string $label => label de la Category
     * @param string $description => description de la Category
     *
     * @return void
     */
    public function __construct(private string $label,private string $description){
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