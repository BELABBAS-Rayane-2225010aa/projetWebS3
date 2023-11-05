<?php

require "../vendor/autoload.php";

use App\Controller\AdminController;

session_start();

$_POST['userId'] = $_SESSION['user']->getUserID();
$_POST['deleteEvenAdmin'] = 'on';

$controller = new AdminController();
$controller->deleteUser();

header('Location: Deconexion.php')
?>