<?php

use App\Repository\CategoryRepository;

require '../vendor/autoload.php';

require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Billet';
require 'HeaderMenu.php';//Charge le bar menu
if(!isset($_POST['billetClique']))
{
    header('Location: ../index.php');
}
$serializedBillet = $_POST['billetClique'];
$billetClique = unserialize(base64_decode($serializedBillet));
if (!$billetClique instanceof \App\Model\Billet) {
    echo 'La désérialisation a échoué';
}

$updateController = new \App\Controller\BilletModifierController();

$categoryRepository = new CategoryRepository();
$arrayCat = $categoryRepository->getCat();
?>
<script src="Bouton.js"></script>
    <button onclick="BoutonAffichageCategorie()" class="buttonCategory"><img src="../View/image/BtnCategorie.ico" /></button><!--Présent qu'en mode portable sert a ameliorer la lisibiliter du billet-->
    <form method="post" action="../index.php">
        <aside id="CategorieID" class="category"><!--affiche les categories du billet-->
            <h2>Categories ID : <?php echo $billetClique->getCategoryId() ?></h2>
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
        </aside>

        <section id="commentID" class="comments"><!--affiche les comentaires du billet-->
            <h2><?php echo $billetClique->getTitle()?></h2>
            <p><?php if(!empty($billetClique->getMsg())){echo $billetClique->getMsg();}else{echo 'ERROR Le message est vide ERROR';}?></p>
            <h3>AuteurID : <?php echo $billetClique->getAuthorId() ?></h3>
            <p>Date : <?php echo $billetClique->getDate() ?></p>
        </section>
    </form>
<?php
end_page();
?>
