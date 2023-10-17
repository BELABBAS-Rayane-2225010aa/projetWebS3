<?php
namespace App;

session_start();

require 'vendor/autoload.php';

use App\Controller\BilletController;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\SignUpController;

$homeController = new HomeController();
$homeController->get5Billet();
/*$cinqBillet = $homeController->getBilletArray();
$_SESSION['BilletHome1'] = $cinqBillet[0]->getTitle();
$_SESSION['BilletHome2'] = $cinqBillet[1]->getTitle();
$_SESSION['BilletHome3'] = $cinqBillet[2]->getTitle();
$_SESSION['BilletHome4'] = $cinqBillet[3]->getTitle();
$_SESSION['BilletHome5'] = $cinqBillet[4]->getTitle();*/

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