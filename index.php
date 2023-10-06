<?php


require './Model/AutoLoader.php';
use App\AutoLoader;
Autoloader::register();


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'action') {
        $controller = new \App\Controller\LoginController();
        $controller->getLogin();
    } else {
        echo 'ERREUR : t nul';
    }
} else {
    echo 'nuuuuuuuul';
}
?>

<a href="View/Login.php"  > clicez bande de salope</a>


