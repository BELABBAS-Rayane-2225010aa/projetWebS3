<?php
require '../vendor/autoload.php';

require 'GestionPage.php';
start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<?php $active = 'categorie';
require 'HeaderMenu.php' //Charge le bar menu ?>
<section class="fomBox">
    <form action="../index.php" method="post">
        <strong> INSCRIPTION </strong>
            <br>
        <label>Pseudo :</label>
        <input name="pseudo" id="Pseudo" type="text" />
            <br>
        <label>e-mail :</label>
        <input name="email" id="email" type="email" />
            <br>
        <label>Confirmer votre e-mail :</label>
        <input name="email1" id="email1" type="email" />
            <br>
        <label>Mot de passe :</label>
        <input name="password" type="password" />

        <label>Confirmez votre mot de passe :</label>
        <input name="password1" type="password" /><br>

        <input type="submit" name="SignUp" value="SignUp"><br>
    </form>

    <p style="color: red"><?php if (isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
</section>
<?php
end_page();
?>