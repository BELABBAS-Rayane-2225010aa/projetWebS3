<?php
require 'GestionPage.php';
start_page('Profil');
$active = 'profil';
require 'headerMenu.php';
?>
    <section class="fomulaire">
        <h1>IMG DE PROFILE</h1>
        <p>PLACEHOLDER_PSEUDO</p><?php //echo $_SESSION['username']?>
        <button>Changer le pseudo</button>
        <p>PLACEHOLDER_MAIL</p>
        <button>Changer l'e-mail</button>
        <p>PLACEHOLDER_MDP</p>
        <button>Changer le mdp</button>
        <!-- img profil
        pseudo
        bouton chnager pseudo
        mail
        bouton changer mail
        ----
        bouton changer mdp
        -->
    </section>
<?php
end_page();
?>