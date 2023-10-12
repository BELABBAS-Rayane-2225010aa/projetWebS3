<?php require 'GestionPage.php' ?>
<?php
start_page('Mon compte');
?>
<?php $active = 'Mon compte';
require 'headerMenu.php' ?>
    <section id="compte_pageId" class="compte">
        <h2>Pseudo</h2>
        <p>Date de création : 00/00/0000</p>
        <h3>Billet écrit:</h3>
        <p>-Billet1,date1
            Billet2,date2</p>
        <h3>Commentaire écrit:</h3>
        <P>-Commentaire1,Date1,Billet1
            -Commentaire1,Date1,Billet1</P>
        <button id='boutonchangerMDP' class='boutonchanger_mdp' onclick="window.location.href='changermdp.php';">changer mot de passe</button>
        <button id='SupCompte' class='suprimer_compte'>Suprimer votre compte</button>
    </section>
<?php
end_page();
?>
