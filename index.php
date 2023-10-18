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
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\SignUpController;

$homeController = new HomeController();
$homeController->get5Billet();


// ENZO
$_SESSION['cinqBillet'] = $homeController->getBilletArray();

header('Location: View/Home.php');

if (isset($_POST['SignIn'])) {
    if ($_POST['SignIn'] === 'SignIn') {
        $controller = new LoginController();
        $controller->getLogin();
        header('Location: View/Home.php');

    } else {
        //TODO : Erreur
        header('Location: View/Home.php');
    }
}

if (isset($_POST['SignUp'])) {
    if ($_POST['SignUp'] === 'SignUp') {
        $controller = new SignUpController();
        $controller->getSignUp();
        header('Location: View/Home.php');
    } else {
        //TODO : Erreur
        header('Location: View/Home.php');
    }
}

if (isset($_GET['billet_id'])) {
    $controller = new BilletController();
    $controller->showBillet();
    $billet = $controller->getBillet();
    header('Location: View/Home.php');
}
?>