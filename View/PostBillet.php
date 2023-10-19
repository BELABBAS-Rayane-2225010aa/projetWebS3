<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}

start_page('Crée un poste');
$active = 'cree_post';
require 'headerMenu.php';
?>
    <section class="fomulaire">
        <form action="../index.php" method="post">
            <strong> Nouvea Post </strong>
            <br>
            <label>Titre :</label>
            <input name="title" id="title" type="text" />
            <br>
            <input name="msg" id="title" type="textbox" />
            <br>
            <input type="submit" name="createPost" value="Publier">
        </form>
    </section>
<?php
end_page();
?>