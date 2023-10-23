<?php
require "../vendor/autoload.php";

session_start();
if(!isset($_SESSION['suid']))
{
    header('Location : Login.php');
    exit();
}

file_put_contents('../Log/[PlaceHolderName].log', $_SESSION['user']->getPseudo()." is deconnected"."\n",FILE_APPEND | LOCK_EX);

unset($_SESSION['suid']);
unset($_SESSION['user']);

header('Location: ../index.php');
?>