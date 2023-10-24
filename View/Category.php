<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Categorie';
require 'HeaderMenu.php';//Charge le bar menu?>
<section class="section-flex">
    <form action="" method="post" id=""></form>
        <button class="btnBillet" value="categorie" name="categoryClick" form="">
                <span class="icone-btn">
                </span>
            <p class="txt-btn">"categorie"</p>
        </button>
</section>
<?php
end_page();
?>
