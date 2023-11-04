<?php
/**
 * Ce fichier fait partie du projet ProjetWebS3.
 *
 * Ce fichier est le Routeur de notre projet, il permet de recevoir toutes les requêtes de l'application et de router chacune vers le bon contrôleur.
 *
 * @package App
 * @copyright 2013 Mon super copyright
 */
namespace App;
session_start();

require 'vendor/autoload.php';

use App\Controller\AdminController;
use App\Controller\BilletController;
use App\Controller\PostBilletController;
use App\Controller\BilletModifierController;
use App\Controller\EmailModifierController;
use App\Controller\LoginController;
use App\Controller\PasswordModifierController;
use App\Controller\PseudoModifierController;
use App\Controller\ResultatRechercheController;
use App\Controller\SignUpController;

header('Location: View/Home.php');

if (isset($_POST['SignIn'])) {
    $controller = new LoginController();
    $controller->getLogin();
    if (isset($_SESSION['msg'])){
        header('Location: View/Login.php');
    }
}

if (isset($_POST['SignUp'])) {
    $controller = new SignUpController();
    $controller->getSignUp();
    if (isset($_SESSION['msg'])){
        header('Location: View/SignUp.php');
    }
}

if(isset($_POST['PasswordModif'])) {
    $controller = new PasswordModifierController();
    $controller->modifPassword();
    header('Location: View/PasswordModifier.php');
}

if(isset($_POST['PseudoModif'])) {
    $controller = new PseudoModifierController();
    $controller->modifPseudo();
    header('Location: View/PseudoModifier.php');
}

if (isset($_POST['EmailModif'])) {
    $controller = new EmailModifierController();
    $controller->modifEmail();
    header('Location: View/EmailModifier.php');
}

if (isset($_POST['NewCat'])) {
    $controller = new AdminController();
    $controller->createCategory();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['DelCat'])) {
    $controller = new AdminController();
    $controller->deleteCategory();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['DelUser'])) {
    $controller = new AdminController();
    $controller->deleteUser();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['DelBillet'])) {
    $controller = new AdminController();
    $controller->deleteBillet();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['DelCommentAdmin'])) {
    $controller = new AdminController();
    $controller->deleteComment();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['DelComment'])) {
    $controller = new BilletController();
    $controller->deleteComment();
    header('Location: View/Billet.php');
}

if (isset($_POST['MakeAdmin'])) {
    $controller = new AdminController();
    $controller->makeAdmin();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['createPost'])) {
    $controller = new PostBilletController();
    $controller->getNewBillet();
}

if(isset($_POST['BilletModif'])){
    $controller = new BilletModifierController();
    $controller->updateBillet();
    header('Location: View/Billet.php');

}

if(isset($_POST['addComment'])){
    $controller = new BilletController();
    $controller->getNewComment();
    header('Location: View/Billet.php');
}

if(isset($_POST['CommentModifier'])){
        $controller = new BilletController();
        $controller->modifComment();
    header('Location: View/Billet.php');
}

if(isset($_POST['makeImportante'])){
    $controller = new BilletController();
    $controller->makeImportante();
    header('Location: View/Billet.php');
}

if(isset($_POST['unMakeImportante'])){
    $controller = new BilletController();
    $controller->unMakeImportante();
    header('Location: View/Billet.php');
}

if(isset($_POST['supBillet'])){
    $controller = new BilletController();
    $controller->deleteBillet();
}
?>