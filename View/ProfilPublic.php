<?php
require '../vendor/autoload.php';

require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body>
<?php
$active = "";
require 'HeaderMenu.php';//Charge le bar menu
if(!isset($_POST['userClique']))
{
    header('Location: ../index.php');
}
$serializedUser = $_POST['userClique'];
$userClique = unserialize(base64_decode($serializedUser));
if (!$userClique instanceof \App\Model\User) {
    echo 'La désérialisation a échoué';
}
?>
    <section class="formBox">
        <p>Pseudo : <?php echo $userClique->getPseudo()?></p>
        <p>Date de création : <?php echo $userClique->getDateFirstCo()?></p><br>
        <p>Billet écrit:</p><br>
        <p>-Billet1,date1
            Billet2,date2</p><br>
        <p>Commentaire écrit:</p><br>
        <p>-Commentaire1,Date1,Billet1
            -Commentaire1,Date1,Billet1</p><br>
    </section>
<?php
end_page();
?>