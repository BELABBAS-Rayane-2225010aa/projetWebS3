<?php

namespace App\Repository;

use App\Exception\CannotAddCommentException;
use App\Exception\CannotModify;
use App\Exception\NotFoundException;
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
            throw new CannotAddCommentException("Le COMMENT ne peut être créer");
        }
        return "Le COMMENT a bien été créer";
    }

    /**
     * Suppression d'un commentaire
     *
     * Cette fonction permet de supprimer un commentaire de la base de donnée
     *
     * @throws NotFoundException
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
            throw new NotFoundException("Le COMMENT d'id : ".$commId." ne peut pas être supprimer");
        }

        return "Le COMMENT d'id : ".$commId."  a bien été supprimé";
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
            throw new CannotModify("Le COMMENT d'id : ".$commId." ne peut pas être modifier");
        }

    }
    public function searchComment(string $recherche) : array
    {
        $query = 'SELECT * FROM COMMENT WHERE TEXTE LIKE "%' . $recherche . '%" ORDER BY COMMENT_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun commentaire trouvé pour : '.$recherche.' ...');
        }
        $arraySQL = $statement->fetchAll();
        $arrayComment = array();

        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $comment = new Comment($arraySQL[$i]['COMMENT_ID'], $arraySQL[$i]['TEXTE'], $arraySQL[$i]['DATE_COM'], $arraySQL[$i]['USER_ID'], $arraySQL[$i]['BILLET_ID'], $arraySQL[$i]['ISIMPORTANTE']);
            $arrayComment[] = $comment;
        }

        return $arrayComment;
    }

    public function getCommentByBillet(int $billetId) : array {
        //on select d'abord tous les comments marqué comme important
        $query = 'SELECT * FROM COMMENT WHERE BILLET_ID = :billetId AND ISIMPORTANTE = 1 ORDER BY DATE_COM DESC';
        $statement1 = $this->connexion -> prepare(
            $query );
        $statement1->execute(['billetId' => $billetId]);

        //on select ensuite tout les comments non marqué comme important
        $query = 'SELECT * FROM COMMENT WHERE BILLET_ID = :billetId AND ISIMPORTANTE = 0 ORDER BY DATE_COM DESC';
        $statement2 = $this->connexion -> prepare(
            $query );
        $statement2->execute(['billetId' => $billetId]);

        //on créer un tableau de billet contenant toutes les données
        $arraySQL1 = $statement1->fetchAll();
        $arraySQL2 = $statement2->fetchAll();
        $arrayComment = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Comment*/
        for ($i = 0; $i < sizeof($arraySQL1); $i++) {
            $comment = new Comment($arraySQL1[$i]['COMMENT_ID'], $arraySQL1[$i]['TEXTE'],$arraySQL1[$i]['DATE_COM'], $arraySQL1[$i]['USER_ID'], $arraySQL1[$i]['BILLET_ID'], $arraySQL1[$i]['ISIMPORTANTE']);
            $arrayComment[] = $comment;
        }

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Comment*/
        for ($i = 0; $i < sizeof($arraySQL2); $i++) {
            $comment = new Comment($arraySQL2[$i]['COMMENT_ID'], $arraySQL2[$i]['TEXTE'],$arraySQL2[$i]['DATE_COM'], $arraySQL2[$i]['USER_ID'], $arraySQL2[$i]['BILLET_ID'], $arraySQL2[$i]['ISIMPORTANTE']);
            $arrayComment[] = $comment;
        }

        return $arrayComment;
    }

    public function updateVote(int $commentId,bool $isPositive){
        if ($isPositive === true){
            $query = 'UPDATE COMMENT SET ISIMPORTANTE = 1 WHERE COMMENT_ID = :commentId';
            $statement = $this->connexion -> prepare(
                $query );
            $statement->execute(['commentId' => $commentId]);
        }
        else {
            $query = 'UPDATE COMMENT SET ISIMPORTANTE = 0 WHERE COMMENT_ID = :commentId';
            $statement = $this->connexion -> prepare(
                $query );
            $statement->execute(['commentId' => $commentId]);
        }

        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Le COMMENT d'id : ".$commentId." n'est pas trouvé'");
        }
    }
}