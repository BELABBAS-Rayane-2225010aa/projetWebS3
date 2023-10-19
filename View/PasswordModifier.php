<?php require 'GestionPage.php' ?>
<?php
start_page('Changer mot de passe');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body><!-- FLEX BLOCK-->
    <?php $active = 'mon compte';
    require 'HeaderMenu.php' ?>
    <section class="fomulaire" >
        <form action="../index.php" method="post">
            <label>Entrez votre mot de passe :
                <input type="password" id="in" name="oldPassword">
            </label><br>
            <label>Nouveau mot de passe :
                <input type="password" id="in" name="newPassword">
            </label><br>
            <label>Confirmer nouveau mot de passe :
            <input type="password" id="in" name="newPassword1">
            </label><br>
            <input type="submit" name="PasswordModif" id='boutonchangerMDP' class='boutonchanger_mdp' value="Changer mon mot de passe">
        </form>
    </section>
<?php
end_page();
?>
