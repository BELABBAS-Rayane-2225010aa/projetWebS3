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

/**
 * La classe Comment permet de gérer les commentaire du forum
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class Comment
{
    /**
     * Le constructeur de la class Comment
     *
     * @param string $text => le text du Comment
     * @param string $date => la date de création du Comment
     * @param int $author => l'id de l'auteur du Comment
     * @param int $billet => l'id du Billet rattaché au Comment
     *
     * @return void
     */
    public function __construct(private string $text, private string $date,
                                private int $author, private int $billet){
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
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }

    /**
     * getter de l'attribut billet
     *
     * @return int
     */
    public function getBillet(): int
    {
        return $this->billet;
    }
}