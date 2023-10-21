<?php

namespace App\Repository;

use App\Exception\CannotDeleteCommentException;
use App\Model\Comment;

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
     *
     * @return Comment => une instance de la class Comment créer pour l'occasion
     */
//    public function addComment(string $texte) : Comment
//    {
//
//        return new Comment();
//    }

    /**
     * Suppression d'un commentaire
     *
     * Cette fonction permet de supprimer un commentaire de la base de donnée
     *
     * @throws CannotDeleteCommentException
     *
     * @return void
     */
    public function delComment(int $commId) : void {
        //TODO : ne permettre cette supression qu'a l'autheur et les admins
        $query = 'DELETE FROM COMMENT WHERE COMMENT_ID = :commId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['commId' => $commId]);

        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteCommentException("COMMENT cannot be deleted");
        }
    }
}