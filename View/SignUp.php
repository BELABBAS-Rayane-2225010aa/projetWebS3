<?php require 'GestionPage.php' ?>
<?php
start_page('Categorie');
?>
<?php $active = 'categorie';
require 'headerMenu.php' ?>
<section class="fomulaire">
    <form action="" method="post">
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
    <input name="$password" id="$password" type="password" />
        <br>
    <label>Confirmez votre mot de passe :</label>
    <input name="$password1" id="$password1" type="password" /><br>
        <br>
    <label>Une image (optionnel)</label><br>
    <input name="imgPath" id="image" type="file" /></p>
        <br>
    <button type="submit">Valider</button>
    </form>
</section>
<?php
end_page();
?>