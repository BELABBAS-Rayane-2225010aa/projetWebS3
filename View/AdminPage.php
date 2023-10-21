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
        <p>Nouvelle catégorie: <br>
            <label>Entrez le nom de la nouvel catégorie :
                <input type="text" name="newCatName">
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

        <p>Suprimer utilisateur: <br>
            <label>Entrez l'ID de l'utilisateur à supprimer :
                <input type="text" id="in" name="userId">
            </label><br>
            <input type="submit" name="DelUser" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
            <br>
        </p>

        <p>Suprimer billet: <br>
            <label>Entrez l'ID du billet à supprimer :
                <input type="text" id="in" name="billetId">
            </label><br>
            <input type="submit" name="DelBillet" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
            <br>
        </p>

        <p>Faire devenir admin: <br>
            <label>Entrez l'ID de l'utilisateur à faire devenir admin :
                <input type="text" id="in" name="userIdAdmin">
            </label><br>
            <input type="submit" name="MakeAdmin" id='boutonchangerMDP' class='boutonchanger_mdp' value="modifier"><br>
        </p>
    </form>
</section>
<?php
end_page();
?>