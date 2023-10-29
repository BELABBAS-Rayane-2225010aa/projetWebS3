<?php

namespace App\Repository;

use App\Exception\CannotDeleteCommentException;
use App\Exception\CannotModify;
use App\Model\Billet;
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
     * @param int $author => l'Id de l'auteur
     * @param int $billet => l'Id billet auquel le commentaire est rattaché
     *
     * @return Comment => une instance de la class Comment créer pour l'occasion
     */
    public function addComment(string $texte, User $author, Billet $billet) : Comment
    {
        $query = 'INSERT INTO COMMENT(TEXTE, DATE_COM, USER_ID, BILLET_ID)
                  VALUES (\':texte\', NOW(), :author, :billet)';
        $statement = $this->connexion->prepare($query);
        $statement->execute(['texte' => $texte, 'author'=>$author, 'billet'=>$billet]);

        if ($statement->rowCount() === 0) {
            throw new CannotDeleteCommentException("COMMENT cannot be added");
        }

        return new Comment($texte, date('Y-m-d'), $author, $billet );
    }

    /**
     * Suppression d'un commentaire
     *
     * Cette fonction permet de supprimer un commentaire de la base de donnée
     *
     * @return void
     * @throws CannotDeleteCommentException
     *
     */
    public function delComment(int $commId): void
    {
        //TODO : ne permettre cette supression qu'a l'autheur et les admins
        $query = 'DELETE FROM COMMENT WHERE COMMENT_ID = :commId';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['commId' => $commId]);

        if ($statement->rowCount() === 0) {
            throw new CannotDeleteCommentException("COMMENT cannot be deleted");
        }
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

        $query = 'UPDATE COMMENT SET TEXTE= \':texte\' WHERE COMMENT_ID= :commId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['commId' => $commId, 'texte'=>$texte]);

        if ( $statement -> rowCount() === 0){
            throw new CannotModify("COMMENT cannot be updated");
        }

    }
}