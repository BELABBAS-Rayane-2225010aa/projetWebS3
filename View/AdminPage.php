<?php
require '../vendor/autoload.php';

require 'GestionPage.php';
start_page('Administration');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body><!-- FLEX BLOCK-->
<?php $active = 'admin';
require 'HeaderMenu.php' ?>
<section class="fomulaire" >
    <form action="../index.php" method="post">
        <p>Nouvelle catégorie : <br>
            <label>Entrez le nom de la nouvel catégorie :
                <input type="text" name="catName">
            </label><br>
            <label>Entrez sa description :
                <textarea name="catDesc"></textarea>
            </label><br>
            <input type="submit" name="NewCat" id='boutonchangerMDP' class='boutonchanger_mdp' value="Ajouter"><br>
            <br>
        </p>

        <p>Suprimer categorie: <br>
            <label>Entrez le nom de la catégorie à supprimer :
                <input type="text" name="catName">
            </label><br>
            <input type="submit" name="DelCat" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
            <br>
        </p>

        <label>Suprimer utilisateur:
            <input type="text" id="in" name="DelAccount">
        </label><br>
        <input type="submit" name="DelA" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
        <br>

        <label>Suprimer Billet:
            <input type="password" id="in" name="DelBillet">
        </label><br>
        <input type="submit" name="DelB" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer">
    </form>
</section>
<?php
end_page();
?>