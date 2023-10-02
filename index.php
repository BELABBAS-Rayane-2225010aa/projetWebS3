<?php require 'View/Page/startpage.php' ?>
<?php
start_page('Acceuil');
?>
<body>
<?php $active = 'index';
require 'View/Page/headerMenu.php' ?>
<button name="Billet1" type="button" class="boutonBillet" onclick="window.location.href='Modules/Pages/Billet.php';">
    Titre1 text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text
    auteur1
</button>
<button name="Billet2" type="button" class="boutonBillet" onclick="window.location.href='Modules/Pages/Billet.php';">
    Titre2
    auteur2
</button>
<button name="Billet3" type="button" class="boutonBillet" onclick="window.location.href='Modules/Pages/Billet.php';">
    Titre3
    auteur3
</button>
<button name="Billet4" type="button" class="boutonBillet" onclick="window.location.href='Modules/Pages/Billet.php';">
    Titre4
    auteur4
</button>
<button name="Billet5" type="button" class="boutonBillet" onclick="window.location.href='Modules/Pages/Billet.php';">
    Titre5
    auteur5
</button>
<?php require 'View/Page/endpage.php' ?>
<?php
end_page();
?>
</body>
</html>