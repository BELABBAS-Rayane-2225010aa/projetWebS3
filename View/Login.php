<?php
require 'GestionPage.php';
start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.

$active = 'connection';
require 'HeaderMenu.php';//Charge le bar menu
?>
<section class="fomulaire">
    <form action="../index.php" method="post">
        <label>
            Login
            <input name="pseudo" type="text">
        </label><br>
        <label>
            Mot de passe
            <input type="password" name="password">
        </label><br>
        <input type="submit"  name="SignIn" value="SignIn">
    </form>
</section>
<?php
end_page();
?>