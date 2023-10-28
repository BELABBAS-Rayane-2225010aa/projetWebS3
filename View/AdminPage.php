<?php
require '../vendor/autoload.php';

require 'GestionPage.php';
start_page('Administration');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body><!-- FLEX BLOCK-->
<?php $active = 'admin';
require 'HeaderMenu.php' ?>
<section id="adminbox" >
    <form action="../index.php" method="post">
        <p>Nouvelle catégorie: <br>
            <label>Entrez le nom de la nouvel catégorie :
                <input type="text" name="newCatName">
            </label><br>
            <label>Entrez sa description :
                <textarea name="catDesc"></textarea>
            </label><br>
            <input type="submit" name="NewCat" id='boutonchangerMDP' class='checkButton' value="Ajouter"><br>
            <br>
        </p>

        <p>Suprimer categorie: <br>
            <label>Entrez le nom de la catégorie à supprimer :
                <input type="text" name="catName">
            </label><br>
            <input type="submit" name="DelCat" id='boutonchangerMDP' class='checkButton' value="suprimer"><br>
            <br>
        </p>

        <p>Suprimer utilisateur: <br>
            <label>Entrez l'ID de l'utilisateur à supprimer :
                <input type="text" id="in" name="userId">
            </label><br>
            <input type="submit" name="DelUser" id='boutonchangerMDP' class='checkButton' value="suprimer"><br>
            <br>
        </p>

        <p>Suprimer billet: <br>
            <label>Entrez l'ID du billet à supprimer :
                <input type="text" id="in" name="billetId">
            </label><br>
            <input type="submit" name="DelBillet" id='boutonchangerMDP' class='checkButton' value="suprimer"><br>
            <br>
        </p>

        <p>Suprimer commentaire: <br>
            <label>Entrez l'ID du commentaire à supprimer :
                <input type="text" id="in" name="commentId">
            </label><br>
            <input type="submit" name="DelComment" id='boutonchangerMDP' class='boutonchanger_mdp' value="suprimer"><br>
            <br>
        </p>

        <p>Faire devenir admin: <br>
            <label>Entrez l'ID de l'utilisateur à faire devenir admin :
                <input type="text" id="in" name="userIdAdmin">
            </label><br>
            <input type="submit" name="MakeAdmin" id='boutonchangerMDP' class='checkButton' value="modifier"><br>
            <br>
        </p>
    </form>
    <p style="color: red"><?php if (isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
</section>
<?php
end_page();
?>