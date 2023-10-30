<?php

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

$billetByCatID = new BilletRepository();
$billet = $billetByCatID->arrayBilletByCatID($catClique->getCatID());
?>
<section class="section-flex">
    <form action="" method="post" id=""></form>

        <button class="btnBillet" value="categorie" name="categoryClick" form="">
                <span class="icone-btn">
                </span>
            <p class="txt-btn">Les Billet Présent Dans la Catégorie : "<?php echo $catClique->getLabel() ?>"</p>
            <p class="txt-btn"> Description : <?php echo $catClique->getDescription() ?> </p>
            <p class="txt-btn">
            <?php
            try {
            $billetByCatID = new BilletRepository();
            $billet = $billetByCatID->arrayBilletByCatID($catClique->getCatID());
            for ($i = 0 ; $i < sizeof($billet) ; ++$i)
            {
                ?>
                <button class="btn-flex" value="<?php echo base64_encode(serialize($billet[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                    <p class="txt-btn"><?php if (isset($billet[$i])){echo $billet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
                </button>
                <?php
            }
            }catch (CannotFindBilletException $e){
                echo 'Cette catégorie ne possède aucun billet';
            }
            ?>
            </p>
        </button>
</section>
<?php
end_page();
?>
