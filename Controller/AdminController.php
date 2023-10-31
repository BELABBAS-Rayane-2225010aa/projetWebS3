<?php
/**
 * Controller de la page Admin.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page Admin
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\CategoryRepository
 * @see \App\Repository\UserRepository
 * @see \App\Repository\BilletRepository
 * @see \App\Repository\CommentRepository
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteBilletException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CannotDeleteCommentException;
use App\Exception\CannotDeleteUserException;
use App\Exception\CannotModify;
use App\Exception\CatAlreadyExistException;
use App\Exception\UserIsAdminException;
use App\Repository\BilletRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;

/**
 * Cette class permet de réaliser les actions : createCategory / deleteCategory / deleteUser / deleteBillet / deleteComment / MakeAdmin
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 */
class AdminController
{
    /**
     * permet de créer une Category
     *
     * @catch CannotCreateCatException
     * @catch CatAlreadyExistException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function createCategory() : void {
        //on recupere les donnees du formulaire
        $name = $_POST['newCatName'];
        $desc = $_POST['catDesc'];

        try {
            $cat = new CategoryRepository();
            $msg = $cat->createCat($name,$desc);
        }

        //on catch si on ne peut pas créer ou si la Category existe déjà
        catch (CannotCreateCatException | CatAlreadyExistException $ERROR){
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
     * permet de supprimer une Category
     *
     * @catch CannotDeleteCatException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function deleteCategory() : void {
        //on recupere les donnees du formulaire
        $name = $_POST['catName'];

        try {
            $cat = new CategoryRepository();
            $msg = $cat->deleteCat($name);
        }

        //on catch si on ne peut pas supprimer
        catch (CannotDeleteCatException $ERROR){
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
     * permet de supprimer un User
     *
     * @catch CannotDeleteUserException
     * @catch UserIsAdminException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function deleteUser() : void {
        //on recupere les donnees du formulaire
        $userId = $_POST['userId'];
        if(isset($_POST['deleteEvenAdmin'])){
            $deleteEvenAdmin = true;
        } else {
            $deleteEvenAdmin = false;
        }

        try {
            $user = new UserRepository();
            $msg = $user->deleteUs($userId,$deleteEvenAdmin);
        }

        //on catch si on ne peut pas supprimer
        catch (CannotDeleteUserException | UserIsAdminException $ERROR){
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
     * permet de supprimer un Billet
     *
     * @catch CannotDeleteBilletException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function deleteBillet() : void {
        //on recupere les donnees du formulaire
        $billetId = $_POST['billetId'];

        try {
            $user = new BilletRepository();
            $msg = $user->deleteBillet($billetId);
        }

        //on catch si on ne peut pas supprimer
        catch (CannotDeleteBilletException $ERROR){
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
     * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     */
    public function deleteComment() : void {
        //on recupere les donnees du formulaire
        $commentId = $_POST['commentId'];

        try {
            $user = new CommentRepository();
            $msg = $user->delComment($commentId);
        }

        //on catch si on ne peut pas supprimer
        catch (CannotDeleteCommentException $ERROR){
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
     * permet de transformer un non admin en admin
     *
     * @catch CannotModify
     * @catch UserIsAdminException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function makeAdmin() : void {
        //on recupere les donnees du formulaire
        $userId = $_POST['userIdAdmin'];

        try {
            $user = new UserRepository();
            $msg = $user->makeAdmin($userId);
        }

        //on catch si on ne peut pas modifier ou si il s'agit d'un admin
        catch (CannotModify | UserIsAdminException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message à l'admin en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}