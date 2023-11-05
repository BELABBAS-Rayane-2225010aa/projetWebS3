<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'A propos';
require 'HeaderMenu.php';//Charge le bar menu?>
<section class="about">
    <label class="aboutlab">
        <p>Ce site internet est réalisé pour un travail de groupe d'étudiant.<br>
        Ce site est libre de droit.<br>
        <p>Réaliser par: Belabbas,Crespin,De Angeli,Hourlay,Roubaud,Rousset</p>
        <p>Il s'agit d'un travail étudiant dans le cadre de notre 2ème année de BUT informatique<br>
            à l'IUT d'Aix-En-Provence</p>
        <p>C'est un projet open source : <a href="https://github.com/BELABBAS-Rayane-2225010aa/projetWebS3">voici notre github</a></p>
    </label><br>
</section>
<?php
end_page();
?>
