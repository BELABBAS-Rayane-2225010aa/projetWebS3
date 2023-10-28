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
}

if (isset($_POST['SignUp'])) {
    $controller = new SignUpController();
    $controller->getSignUp();
    if (isset($_SESSION['msg'])){
        header('Location: View/SignUp.php');
    }
}

if (isset($_GET['billet_id'])) {
    $controller = new BilletController();
    $controller->showBillet();
    $billet = $controller->getBillet();
}

if(isset($_POST['PasswordModif'])) {
    $controller = new PasswordModifierController();
    $controller->ModifPassword();
    header('Location: View/PasswordModifier.php');
}

if(isset($_POST['PseudoModif'])) {
    $controller = new PseudoModifierController();
    $controller->ModifPseudo();
    header('Location: View/PseudoModifier.php');
}

if (isset($_POST['EmailModif'])) {
    $controller = new EmailModifierController();
    $controller->ModifEmail();
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

if (isset($_POST['DelComment'])) {
    $controller = new AdminController();
    $controller->deleteComment();
}

if (isset($_POST['MakeAdmin'])) {
    $controller = new AdminController();
    $controller->makeAdmin();
    header('Location: View/AdminPage.php');
}

if (isset($_POST['createPost'])) {
    $controller = new BilletController();
    $controller->getNewBillet();
}

if(isset($_POST['BilletModif'])){
    $controller = new BilletModifierController();
    $controller->updateBillet();
}
?>