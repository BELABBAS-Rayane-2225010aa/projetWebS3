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

//Permet de se connecter
if (isset($_POST['SignIn'])) {
    $controller = new LoginController();
    $controller->getLogin();
    if (isset($_SESSION['msg'])){
        header('Location: View/Login.php');
    }
}

//Permet de s'inscrire
if (isset($_POST['SignUp'])) {
    $controller = new SignUpController();
    $controller->getSignUp();
    if (isset($_SESSION['msg'])){
        header('Location: View/SignUp.php');
    }
}

//Permet de modifier le mot de passe
if(isset($_POST['PasswordModif'])) {
    $controller = new PasswordModifierController();
    $controller->modifPassword();
    header('Location: View/PasswordModifier.php');
}

//Permet de modifier le pseudo
if(isset($_POST['PseudoModif'])) {
    $controller = new PseudoModifierController();
    $controller->modifPseudo();
    header('Location: View/PseudoModifier.php');
}

//Permet de modifier le mail
if (isset($_POST['EmailModif'])) {
    $controller = new EmailModifierController();
    $controller->modifEmail();
    header('Location: View/EmailModifier.php');
}

//Permet de créer une nouvelle catégorie
if (isset($_POST['NewCat'])) {
    $controller = new AdminController();
    $controller->createCategory();
    header('Location: View/AdminPage.php');
}

//Permet de supprimer une catégorie
if (isset($_POST['DelCat'])) {
    $controller = new AdminController();
    $controller->deleteCategory();
    header('Location: View/AdminPage.php');
}

//Permet de supprimer un utilisateur
if (isset($_POST['DelUser'])) {
    $controller = new AdminController();
    $controller->deleteUser();
    header('Location: View/AdminPage.php');
}

//Permet de supprimer un billet
if (isset($_POST['DelBillet'])) {
    $controller = new AdminController();
    $controller->deleteBillet();
    header('Location: View/AdminPage.php');
}

//Permet de supprimer un commentaire dans la page admin
if (isset($_POST['DelCommentAdmin'])) {
    $controller = new AdminController();
    $controller->deleteComment();
    header('Location: View/AdminPage.php');
}

//Permet de supprimer un commentaire dans la page billet
if (isset($_POST['DelComment'])) {
    $controller = new BilletController();
    $controller->deleteComment();
    header('Location: View/Billet.php');
}

//Permet de transformet en admin
if (isset($_POST['MakeAdmin'])) {
    $controller = new AdminController();
    $controller->makeAdmin();
    header('Location: View/AdminPage.php');
}

//Permet de créer un Billet
if (isset($_POST['createPost'])) {
    $controller = new PostBilletController();
    $controller->getNewBillet();
    header('Location: View/PostBillet.php');
}

//Permet de modifier un Billet
if(isset($_POST['BilletModif'])){
    $controller = new BilletModifierController();
    $controller->updateBillet();

}

//Permet d'ajouter un commentaire
if(isset($_POST['addComment'])){
    $controller = new BilletController();
    $controller->getNewComment();
    header('Location: View/Billet.php');
}

//Permet de modifier un commentaire
if(isset($_POST['CommentModifier'])){
        $controller = new BilletController();
        $controller->modifComment();
    header('Location: View/Billet.php');
}

//Permet de rendre important un commentaire
if(isset($_POST['makeImportante'])){
    $controller = new BilletController();
    $controller->makeImportante();
    header('Location: View/Billet.php');
}

//Permet de faire l'effet inverse de la fonction au dessus
if(isset($_POST['unMakeImportante'])){
    $controller = new BilletController();
    $controller->unMakeImportante();
    header('Location: View/Billet.php');
}

//permet de supprimet un billet
if(isset($_POST['supBillet'])){
    $controller = new BilletController();
    $controller->deleteBillet();
}
?>