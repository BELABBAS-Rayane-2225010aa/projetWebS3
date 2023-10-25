<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

use App\Repository\CategoryRepository;

if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}



start_page('Crée un poste');
$active = 'cree_poste';
require 'HeaderMenu.php';
$categoryRepository = new CategoryRepository();
$arrayCat = $categoryRepository->getCat();
?>
    <section class="formBox">
        <form action="../index.php" method="post">
            <strong> Nouveau Post </strong>
            <br>
            <label for="title">Titre :</label>
            <input name="title" id="title" type="text" />
            <label for="category">Categorie :</label>
            <select id="category" name="category">
                <?php
                for ($i = 0 ; $i < sizeof($arrayCat) ; ++$i)
                {
                ?>
                    <option value="<?php echo $arrayCat[$i]["CAT_ID"] ?>"><?php echo $arrayCat[$i]["LABEL"] ?></option>
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