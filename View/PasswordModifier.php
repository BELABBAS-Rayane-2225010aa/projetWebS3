<?php require 'GestionPage.php' ?>
<?php
start_page('Changer mot de passe');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body><!-- FLEX BLOCK-->
    <?php $active = 'mon compte';
    require 'HeaderMenu.php' ?>
    <section class="fomulaire">
        <p>Entrez votre mot de passe :</p>
        <input type="text" id="in">
        <p>Nouveau mot de passe :</p>
        <input type="text" id="in">
        <p>Confirmer nouveau mot de passe :</p>
        <input type="text" id="in">
        <div></div>
        <button id='boutonchangerMDP' class='boutonchanger_mdp' onclick="window.location.href='changermdp.php';">changer mot de passe</button>

    </section>
<?php
end_page();
?>
