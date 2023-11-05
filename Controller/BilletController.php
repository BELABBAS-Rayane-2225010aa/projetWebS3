<?php

namespace App\Controller;

use App\Exception\CannotCreateCommentException;
use App\Exception\CannotModify;
use App\Repository\BilletRepository;
use App\Repository\CommentRepository;
use App\Exception\NotFoundException;

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
     * @catch NotFoundException
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
        catch (NotFoundException $ERROR) {
            $msg = $ERROR->getMessage();
        }

        //on envoie un message à l'admin en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg . "\n", FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    public function modifComment()
    {
        $commentId = $_POST['CommentModifier'];
        $texte = $_POST['texteModif' . $_POST['CommentModifier']];

        try {
            $user = new CommentRepository();
            $msg = $user->updComment($commentId, $texte);
        } //on catch si on ne peut pas modifier
        catch (CannotModify $ERROR) {
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
     * permet de rendre un Comment important
     *
     * @catch NotFoundException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     */
    public function makeImportante(): void
    {
        //on recupére l'id du Comment via le formulaire
        $commentId = $_POST['makeImportante'];

        try {
            $comment = new CommentRepository();
            $comment->updateVote($commentId,true);      //true si on le met important, false sinon
        }

        //on catch si l'id du Comment n'est pas trouvé dans la BD
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
        }
    }

    /**
     * permet de rendre un Comment non important
     *
     * @catch NotFoundException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     */
    public function unMakeImportante(): void
    {
        //on recupére l'id du Comment via le formulaire
        $commentId = $_POST['unMakeImportante'];

        try {
            $comment = new CommentRepository();
            $comment->updateVote($commentId,false);      //true si on le met important, false sinon
        }

        //on catch si l'id du Comment n'est pas trouvé dans la BD
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
        }
    }

    /**
     * permet de supprimer un Billet
     *
     * @catch NotFoundException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function deleteBillet() : void {
        //on recupere les donnees du formulaire
        $billetId = $_POST['supBillet'];

        try {
            $user = new BilletRepository();
            $msg = $user->deleteBillet($billetId);
        }

        //on catch si on ne peut pas supprimer car le billet n'est pas trouvé
        catch (NotFoundException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}