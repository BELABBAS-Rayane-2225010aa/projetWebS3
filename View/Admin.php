<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

start_page('Admin');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
$active = 'admin';
require 'HeaderMenu.php';//Charge le bar menu
?>

<form action="../index.php" method="post">
    <label>Entrez le nom de la nouvel catégorie :
        <input type="text" name="catName">
    </label><br>
    <label>Entrez sa description :
        <textarea name="catDesc"></textarea>
    </label><br>
    <input type="submit" name="NewCat" value="Nouvelle Category">
</form>