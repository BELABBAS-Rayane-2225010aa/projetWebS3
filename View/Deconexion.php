<?php
session_start();
if(!isset($_SESSION['suid']))
{
    header('Location : Login.php');
    exit();
}

unset($_SESSION['suid']);
unset($_SESSION['user']);

header('Location: ../index.php');
?>