<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Billet';
require 'HeaderMenu.php';//Charge le bar menu?>
<section class="section-flex">
    <form action="Billet.php" method="post" id="billetform"></form>
        <button class="btnBillet" value="billet ici" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
            <p class="txt-btn">"titre"</p>
        </button>
</section>
<?php
end_page();
?>
