<?php

use App\Controller\CategoryController;
use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Categorie';
require 'HeaderMenu.php';//Charge le bar menu
if(!isset($_POST['catClique']))
{
    header('Location: ../index.php');
}
$serializedCat = $_POST['catClique'];
$catClique = unserialize(base64_decode($serializedCat));
if (!$catClique instanceof \App\Model\Category) {
    echo 'La désérialisation a échoué';
}
$billetByCatID = new CategoryController();

?>
<section class="misenforme">
    <form action="Billet.php" method="post" id="reche">
        <p class="txt-btn">Nom : <?php echo $catClique->getLabel() ?></p>
        <p class="txt-btn"> Description : <?php echo $catClique->getDescription() ?> </p>
        <p class="txt-btn">Les Billet présent dans <?php echo $catClique->getLabel() ?> :</p>
        <p class="txt-btn">  <?php $billetByCatID->getBilletByCat(); ?> </p>
        <p class="misenforme">

        <?php
        $billet =  $billetByCatID->getBilletByCatArray();
        for ($i = 0 ; $i < sizeof($billet) ; ++$i)
        {
            ?>
            <button class="btnBilletCategory" value="<?php echo base64_encode(serialize($billet[$i]));?>" name="billetClique">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (isset($billet[$i])){echo $billet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
            </button>
            <?php
        }
        ?>
        </p>
    </form>
</section>
<?php
end_page();
?>
