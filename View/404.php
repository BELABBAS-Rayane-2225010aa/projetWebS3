<?php require 'GestionPage.php' ?>
<?php start_page('404'); ?>
<body><!-- FLEX BLOCK-->
    <?php $active = '404';
    require 'headerMenu.php' ?>
    <section class="section404">
        <h1>404 Page introuvable!</h1>
        <h2>Vous vous êtes perdu !</h2>
        <img class="image404" src="https://th.bing.com/th/id/OIG.4DKj3q0Y6tlL0zjwrZSq?pid=ImgGn">
    </section>
<?php
end_page();
?>

