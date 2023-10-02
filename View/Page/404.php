<?php require 'startpage.php' ?>
<?php
start_page('Acceuil');
?>
<body><!-- FLEX BLOCK-->
<?php $active = 'index';
require 'headerMenu.php' ?>

<h1>404 Page introuvable!</h1>
<h2>Vous vous etes perdu !</h2>
<?php require 'endpage.php' ?>
<?php
end_page();
?>
</body>
</html>
