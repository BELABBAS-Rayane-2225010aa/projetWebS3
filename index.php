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

use App\Controller\BilletController;
use App\Controller\EmailModifierController;
use App\Controller\LoginController;
use App\Controller\PasswordModifierController;
use App\Controller\PseudoModifierController;
use App\Controller\SignUpController;
use function Parsica\Parsica\isEqual;

header('Location: View/Home.php');

if (isset($_POST['SignIn'])) {
    if ($_POST['SignIn'] === 'SignIn') {
        $controller = new LoginController();
        $controller->getLogin();
    } else {
        //TODO : Erreur
    }
}

if (isset($_POST['SignUp'])) {
    if ($_POST['SignUp'] === 'SignUp') {
        $controller = new SignUpController();
        $controller->getSignUp();
    } else {
        //TODO : Erreur
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
}

if(isset($_POST['PseudoModif'])) {
    $controller = new PseudoModifierController();
    $login = $controller->ModifPseudo();
    $_SESSION['user']->setPseudo($login->getPseudo());
}

if (isset($_POST['EmailModif'])) {
    $controller = new EmailModifierController();
    $login = $controller->ModifPseudo();
    $_SESSION['user']->setEmail($login->getEmail());
}
?>