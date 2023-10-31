<?php
/**
 * Model représnetant les Billet
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\BilletRepository
 * @see \App\Controller\PostBilletController
 *
 * @version 1.0
 */

namespace App\Model;
/**
 * La classe Billet permet de gérer les Billet du forum
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class Billet
{
    /**
     * Le constructeur de la class Billet
     *
     * @param string $title => titre du Billet
     * @param string $msg => message du Billet
     * @param string $date => date de la création du Billet
     * @param int $authorId => l'id de  l'User auteur du Billet
     * @param int $categoryId => l'id de la Category rattaché au Billet
     *
     * @return void
     */
    public function __construct (private int $billetId, private string $title,
                                 private string $msg,private string $date,
                                private int $authorId,private int $categoryId){
    }

    /**
     * getter de l'attibut title
     *
     * @return int
     */
    public function getBilletId(): int
    {
        return $this->billetId;
    }


    /**
     * getter de l'attibut title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * getter de l'attibut msg
     *
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * getter de l'attibut date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * getter de l'attibut author
     *
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * getter de l'attibut category
     *
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}