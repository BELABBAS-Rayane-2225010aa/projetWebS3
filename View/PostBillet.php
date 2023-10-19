<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}

start_page('Crée un poste');
$active = 'cree_poste';
require 'headerMenu.php';
?>
    <section class="fomulaire">
        <form action="../index.php" method="post">
            <strong> Nouvea Post </strong>
            <br>
            <label for="title">Titre :</label>
            <input name="title" id="title" type="text" />
            <label for="category">Categorie :</label>
            <select id="category" name="categorie">
                <?php
                for ($i = 1 ; $i < 6 ; ++$i)
                { //TODO: Remplacer $i par les vrai categorie
                ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <textarea name="msg" id="msg" placeholder=""></textarea>
            <br>
            <input type="submit" name="createPost" value="Publier">
        </form>
    </section>
<?php
end_page();
?>