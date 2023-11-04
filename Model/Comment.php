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
     * @param int $commentId => l'identifiant du commentaire
     * @param string $text => le text du Comment
     * @param string $date => la date de création du Comment
     * @param int $author => l'id de l'auteur du Comment
     * @param int $billet => l'id du Billet rattaché au Comment
     *
     * @return void
     */
    public function __construct(private int $commentId, private string $text, private string $date,
                                private int $author, private int $billet,private int $isImportante){
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

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    /**
     * getter de l'attibut nbVote
     *
     * @return int
     */
    public function isImportante(): int
    {
        return $this->isImportante;
    }

    /**
     * getter qui permet de réduire l'affichage de l'attribut texte permettant de faire une sorte de titre
     *
     * @return string
     */
    public function getTitle(): string
    {
        $title = "";
        $text = $this->getText();
        $cmptSpace = 0;
        $i = 0;
        while ($cmptSpace != 5){
            if ($i >= strlen($text)){break;}
            if(substr($text,$i,1) === " "){
                $cmptSpace = $cmptSpace + 1;
            }
            $title = $title.substr($text,$i,1);
            $i = $i + 1;
        }
        return $title." ...";
    }
}