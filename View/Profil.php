<?php
require '../vendor/autoload.php';

require 'GestionPage.php';
if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}
start_page('Profil');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
$active = 'profil';
require 'HeaderMenu.php';//Charge le bar menu
?>
    <section class="fromBox">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <button onclick="window.location.href='PseudoModifier.php';">Changer le pseudo</button>
        <p>E-mail :<?php echo $_SESSION['user']->getEmail() ?></p>
        <button onclick="window.location.href='EmailModifier.php';">Changer l'e-mail</button><br>
        <p>Date de création : 00/00/0000</p><br>
        <p>Billet écrit:</p><br>
        <p>-Billet1,date1
            Billet2,date2</p><br>
        <p>Commentaire écrit:</p><br>
        <p>-Commentaire1,Date1,Billet1
            -Commentaire1,Date1,Billet1</p><br>
        <button onclick="window.location.href='PasswordModifier.php';">Changer le mdp</button>
    </section>
<?php
end_page();
?>