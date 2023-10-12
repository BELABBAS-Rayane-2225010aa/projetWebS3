<?php
session_start();
if(!isset($_SESSION['suid']))
{
    header('Location : Login.php');
    exit();
}

unset($_SESSION['suid']);

header('Location: ../index.php');
?>