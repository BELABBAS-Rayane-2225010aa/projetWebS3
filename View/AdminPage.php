<?php require 'GestionPage.php' ?>
<?php
start_page('Administration');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body><!-- FLEX BLOCK-->
<?php $active = 'admin';
require 'HeaderMenu.php' ?>
<section class="fomulaire" >
    <form action="../index.php" method="post">
        <label>Ajouter categorie:
            <input type="text" id="in" name="NewCategorie">
        </label><br>
        <input type="submit" name="AddC" id='boutonchangerMDP' class='boutonchanger_mdp' value="Ajouter"><br>
        <label>Suprimer categorie:
            <input type="text" id="in" name="DelCategorie">
        </label><br>
        <input type="submit" name="DelC" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
        <label>Suprimer utilisateur:
            <input type="text" id="in" name="DelAccount">
        </label><br>
        <input type="submit" name="DelA" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
        <label>Suprimer Billet:
            <input type="password" id="in" name="DelBillet">
        </label><br>
        <input type="submit" name="DelB" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer">
    </form>
</section>
<?php
end_page();
?>