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
    <section class="fomulaire">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <button>Changer le pseudo</button>
        <p>E-mail :<?php echo $_SESSION['user']->getEmail() ?></p>
        <button>Changer l'e-mail</button><br>
        <button>Changer le mdp</button>
    </section>
<?php
end_page();
?>