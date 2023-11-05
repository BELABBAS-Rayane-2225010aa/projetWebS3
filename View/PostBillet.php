<?php

require '../vendor/autoload.php';
require 'GestionPage.php';

use App\Repository\CategoryRepository;

if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}



start_page('Crée un poste');
$active = '';
require 'HeaderMenu.php';
$categoryRepository = new CategoryRepository();
$arrayCat = $categoryRepository->getCategorieInstance();
?>
    <section id="adminbox">
        <form action="../index.php" method="post">
            <h2 id="login"> Nouveau Post </h2>
            <br>
            <label for="title">Titre :</label>
            <input name="title" id="title" type="text" />
            <label for="category">Categorie :</label>
            <select id="category" name="category">
                <?php
                for ($i = 0 ; $i < sizeof($arrayCat) ; ++$i)
                {
                ?>
                    <option value="<?php echo $arrayCat[$i]->getCatID() ?>"><?php echo $arrayCat[$i]->getLabel() ?></option>
                <?php
                }
                ?>
            </select>
            <input name="authorID" type="hidden" value="<?php echo $_SESSION['user']->getUserId()?>"/>
            <br>
            <textarea name="msg" id="msg" placeholder=""></textarea>
            <br>
            <input type="submit" name="createPost" value="Publier">
        </form>
        <p style="color: red"><?php if (isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
    </section>
<?php
end_page();
?>