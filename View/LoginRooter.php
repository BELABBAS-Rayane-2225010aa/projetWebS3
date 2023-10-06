<?php
require '../Model/AutoLoader.php';
Autoloader::register();

var_dump('sort ');
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'action') {
        $controller = new \Controller\LoginController();
        $controller->getLogin();
    } else {
        echo 'ERREUR : t nul';
    }
}
else{
    echo 'nuuuuuuuul';
    }
?>

