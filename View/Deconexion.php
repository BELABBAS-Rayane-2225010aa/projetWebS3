<?php
require "../vendor/autoload.php";

session_start();
if(!isset($_SESSION['suid']))
{
    header('Location : Login.php');
    exit();
}

$deconnect = new \App\Repository\UserConnectedRepository();
$msg = $deconnect->logOut($_SESSION['user']);
file_put_contents('../Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);

unset($_SESSION['suid']);
unset($_SESSION['user']);

header('Location: ../index.php');
?>