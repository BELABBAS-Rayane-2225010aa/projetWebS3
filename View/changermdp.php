<?php require 'startpage.php' ?>
<?php
start_page('Changer mot de passe');
?>
<body><!-- FLEX BLOCK-->
    <?php $active = 'mon compte';
    require 'headerMenu.php' ?>
    <section id="changermdp" class="changer_mdp">
        <p>Entrez votre mot de passe :</p>
        <input type="text" id="in">
        <p>Nouveau mot de passe :</p>
        <input type="text" id="in">
        <p>Confirmer nouveau mot de passe :</p>
        <input type="text" id="in">
        <div></div>
        <button id='boutonchangerMDP' class='boutonchanger_mdp' onclick="window.location.href='changermdp.php';">changer mot de passe</button>

    </section>
<?php require 'endpage.php' ?>
<?php
end_page();
?>
</body>
</html>