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
    <section class="fomBox">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <p>Date de création : 00/00/0000</p><br>
        <p>Billet écrit:</p><br>
        <p>-Billet1,date1
            Billet2,date2</p><br>
        <p>Commentaire écrit:</p><br>
        <P>-Commentaire1,Date1,Billet1
            -Commentaire1,Date1,Billet1</P><br>
    </section>
<?php
end_page();
?>