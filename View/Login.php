<?php require 'GestionPage.php' ?>
<?php
start_page('Categorie');
?>
<?php $active = 'categorie';
require 'headerMenu.php' ?>
<section class="fomulaire">
    <form action="../index.php" method="get">
    Login<input name="login" type="text"><br>
    Mot de passe <input type="password" name="password"><br>
    <input type="submit"  name="action" value="action">
</section>
<?php
end_page();
?>

