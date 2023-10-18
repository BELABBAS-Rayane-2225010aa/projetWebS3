<?php
/**
 * Model représnetant les Billet
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\BilletRepository
 * @see \App\Controller\BilletController
 *
 * @version 1.0
 *
 * @todo : faire en sorte que récupérer l'id
 */

namespace App\Model;

class Billet
{
    /**
     * Le constructeur de la class Billet
     *
     * @param string $title => titre du Billet
     * @param string $msg => message du Billet
     * @param string $date => date de la création du Billet
     * @param int $author_id => l'id de  l'User auteur du Billet
     * @param int $category_id => l'id de la Category rattaché au Billet
     *
     * @return void
     *
     * @todo : faire passer les attribut de public à private
     * @todo : changer le nom des variable author_id et category_id en authorId et categoryId
     */
    public function __construct(public string $title,public string $msg,public string $date,
                                public int $author_id,public int $category_id){
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
        return $this->author_id;
    }

    /**
     * getter de l'attibut category
     *
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }
}