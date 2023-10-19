<?php require 'GestionPage.php' ?>
<?php
start_page('Changer pseudo');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body><!-- FLEX BLOCK-->
    <?php $active = 'mon compte';
    require 'HeaderMenu.php' ?>
    <section class="fomulaire" >
        <form action="../index.php" method="post">
            <label>Entrez votre pseudo actuel :
                <input type="text" id="in" name="oldPseudo">
            </label><br>
            <label>Nouveau pseudo :
                <input type="text" id="in" name="newPseudo">
            </label><br>
            <label>Entrez votre mot de passe :
                <input type="text" id="in" name="password">
            </label><br>
            <input type="submit" name="PseudoModif" id='boutonchangerMDP' class='boutonchanger_mdp' value="Changer mon pseudo">
        </form>
    </section>
<?php
end_page();
?>
