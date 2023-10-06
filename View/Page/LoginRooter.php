<?php

require('../Controller/LoginController.php');

if (isset($_GET['action'])){
    if ($_GET['action'] === 'getLogin'){
        $controller = new \Controller\LoginController();
        $controller->getLogin();
    }
    else{
        echo 'ERREUR : t nul';
    }
}
