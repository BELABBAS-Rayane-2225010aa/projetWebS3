<?php

namespace App\Controller;

use App\Exception\CannotCreateCommentException;
use App\Exception\CannotDeleteCommentException;
use App\Repository\CommentRepository;
use App\Exception\NotFoundException;
use App\Model\Billet;
use App\Model\User;
use phpDocumentor\Reflection\Types\Boolean;

class BilletController
{
    /**
     * permet de créer un commentaire
     *
     * @catch CannotCreateCommentException
     *
     *
     * @return void
     */
    public function getNewComment() : void {
        //on recupere les donnees du formulaire et on en creer de nouvelles
        $texte = $_POST['texteComment'];
        $authorID = $_POST['userID'];
        $billetId = $_POST['billetID'];
        date_default_timezone_set("Europe/Paris");
        $dateComment = date("Y-m-d H:i:s");
        try{
            $comment = new CommentRepository();
            $msg = $comment->addComment($texte,$dateComment, $authorID, $billetId);
        }

            //on catch si on ne peut pas creer le Commentaire
        catch (CannotCreateCommentException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message à l'admin en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    /**
     * permet de supprimer un Comment
     *
     * @catch CannotDeleteCommentException
     *
     *
     *
     * @return void
     */
    public function deleteComment() : void
    {
        //on recupere les donnees du formulaire
        $commentId = $_POST['DelComment'];

        try {
            $user = new CommentRepository();
            $msg = $user->delComment($commentId);
        } //on catch si on ne peut pas supprimer
        catch (CannotDeleteCommentException $ERROR) {
            $msg = $ERROR->getMessage();
        }

        //on envoie un message à l'admin en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg . "\n", FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    /**
     * permet d'ajouté ou supprimer un upvote
     *
     * @catch NotFoundException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     */
    public function makeImportante(): void
    {
        $commentId = $_POST['makeImportante'];

        try {
            $comment = new CommentRepository();
            $comment->updateVote($commentId,true);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
        }
    }

    public function unMakeImportante(): void
    {
        $commentId = $_POST['unMakeImportante'];

        try {
            $comment = new CommentRepository();
            $comment->updateVote($commentId,false);
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
        }
    }
}