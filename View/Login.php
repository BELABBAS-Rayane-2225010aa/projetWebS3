<?php
require 'GestionPage.php';
start_page('Categorie');

$active = 'connexion';
require 'headerMenu.php';
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