<?php
/**
 * Model représnetant les Billet
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\[NomDeRepositoryPlaceHolder]
 * @see \App\Controller\[NomDeControllerPlaceHolder]
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
     * @param string $title         => titre du Billet
     * @param string $msg           => message du Billet
     * @param string $date          => date de la création du Billet
     * @param User $authorId        => l'id de  l'User autheur du Billet
     * @param Category $categoryId  => l'id de la Category rattaché au Billet
     *
     * @return void
     */
    public function __construct(public string $title,public string $msg,public string $date,
                                public int $authorId,public int $categoryId){
    }

    /**
     * getter de l'attribut id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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