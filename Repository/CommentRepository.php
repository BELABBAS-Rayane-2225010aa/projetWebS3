<?php

namespace App\Repository;

use App\Exception\CannotAddCommentException;
use App\Exception\CannotDeleteCommentException;
use App\Exception\CannotModify;
use App\Model\Billet;
use App\Exception\NotFoundException;
use App\Model\Comment;
use App\Model\User;

/**
 * La classe CommentRepository permet de gérer les requête SQL relatifs aux Commentaire
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 */
class CommentRepository extends AbstractRepository
{
    /**
     * Le constructeur de la classe CommentRepository
     *
     * on appelle le constructeur de la class parent AbstractRepository
     * pour récupérer la connexion à la BD
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction de création de commentaire
     *
     * Cette fonction permet de créer un Comm
     *
     * @param string $texte => le texte du commentaire
     * @param string $date => la date de création du commentaire
     * @param int $authorId => l'Id de l'auteur
     * @param int $billetId => l'Id billet auquel le commentaire est rattaché
     *
     * @return string
     */
    public function addComment(string $texte, string $date, int $authorId, int $billetId) : string
    {
        $query = 'INSERT INTO COMMENT(TEXTE, DATE_COM, USER_ID, BILLET_ID) VALUES (:texte, :date, :author, :billet)';
        $statement = $this->connexion->prepare($query);
        $statement->execute(['texte' => $texte, 'date'=>$date, 'author'=>$authorId, 'billet'=>$billetId]);

        if ($statement->rowCount() === 0) {
            throw new CannotAddCommentException("COMMENT cannot be added");
        }
        return "Commentaire crée";
    }

    /**
     * Suppression d'un commentaire
     *
     * Cette fonction permet de supprimer un commentaire de la base de donnée
     *
     * @param int $commId
     * @return string
     */
    public function delComment(int $commId): string
    {
        //TODO : ne permettre cette supression qu'a l'autheur et les admins
        $query = 'DELETE FROM COMMENT WHERE COMMENT_ID = :commId';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['commId' => $commId]);

        if ($statement->rowCount() === 0) {
            throw new CannotDeleteCommentException("COMMENT cannot be deleted");
        }

        return "COMMENT successfully deleted";
    }

    /** Modification d'un commentaire
     *
     * Cette fonction permet de modifier un commentaire de la base de donnée
     *
     * @param string $texte => le nouveau texte à modifier
     * @param int $commId => l'Id du commentaire
     *
     * @return void
     * @throws CannotModify
     *
     */

    public function updComment(int $commId, string $texte): void
    {
        //TODO : ne permettre qu'à l'auteur et aux admins de le modifier

        $query = 'UPDATE COMMENT SET TEXTE= :texte WHERE COMMENT_ID= :commId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['commId' => $commId, 'texte'=>$texte]);

        if ( $statement -> rowCount() === 0){
            throw new CannotModify("COMMENT cannot be updated");
        }

    }
    public function searchComment(string $q) : array
    {
        $query = 'SELECT * FROM COMMENT WHERE TEXTE LIKE "%' . $q . '%" ORDER BY COMMENT_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun commentaire trouvé pour '.$q.' .');
        }
        $arraySQL = $statement->fetchAll();
        $arrayComment = array();

        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $comment = new Comment($arraySQL[$i]['TEXTE'], $arraySQL[$i]['DATE_COMM'], $arraySQL[$i]['USER_ID'], $arraySQL[$i]['BILLET_ID']);
            $arrayComment[] = $comment;
        }

        return $arrayComment;
    }
}