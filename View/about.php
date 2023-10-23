<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'about';
require 'HeaderMenu.php';//Charge le bar menu?>
<section class="fomBox">
    <label>
        Ce site internet est réalisé pour un travail de groupe d'étudiant.<br>
        Ce site est libre de droit.<br>
        Réaliser par: Belabbas,Créspin,De Angeli,Hourlay,Roubaud,Rousset
    </label><br>
</section>
<?php
end_page();
?>
