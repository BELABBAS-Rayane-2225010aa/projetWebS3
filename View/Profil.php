<?php
require '../vendor/autoload.php';

require 'GestionPage.php';
if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}
start_page('Profil');
$active = 'profil';
require 'headerMenu.php';
$ImgPath='image/Default_pfp.jpg'
?>
    <section class="fomulaire">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <button>Changer le pseudo</button>
        <p>E-mail :<?php echo $_SESSION['user']->getEmail() ?></p>
        <button>Changer l'e-mail</button>
        <button>Changer le mdp</button>
    </section>
<?php
end_page();
?>