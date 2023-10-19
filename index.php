<?php
namespace App;

session_start();

require 'vendor/autoload.php';

use App\Controller\BilletController;
use App\Controller\LoginController;
use App\Controller\SignUpController;

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

if (isset($_POST['createPost'])) {
    if ($_POST['createPost'] === 'Publier') {
        // TODO: createPost() dans BilletController et BilletRepository
        header('Location: View/Home.php');
    } else {
        //TODO : Erreur
        header('Location: View/Home.php');
    }
}
?>