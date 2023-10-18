<?php
/**
 * Model représentant les Commentaires
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\[NomDeRepositoryPlaceHolder]
 * @see \App\Controller\[NomDeControllerPlaceHolder]
 *
 * @version 1.0
 */

namespace App\Model;

class Comment
{
    /**
     * Le constructeur de la class Comment
     *
     * @param string $text => le text du Comment
     * @param string $date => la date de création du Comment
     * @param User $author => l'id de l'auteur du Comment
     * @param Billet $billet => l'id du Billet rattaché au Comment
     *
     * @return void
     */
    public function __construct(private string $text, private string $date,
                                private User $author, private Billet $billet){
    }

    /**
     * getter de l'attribut text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * getter de l'attribut date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * getter de l'attribut author
     *
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * getter de l'attribut billet
     *
     * @return Billet
     */
    public function getBillet(): Billet
    {
        return $this->billet;
    }
}