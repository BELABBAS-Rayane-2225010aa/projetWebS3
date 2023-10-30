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
<section id="reche">
    <form action="" method="post" id=""></form>

            <p class="txt-btn">Les Billet Présent Dans la Catégorie : "<?php echo $catClique->getLabel() ?>"</p>
            <p class="txt-btn"> Description : <?php echo $catClique->getDescription() ?> </p>
            <P class="txt-btn"> <?php echo $catClique->getCatID() ?> </P>
            <p class="billetform">
            <?php
            for ($i = 0 ; $i < sizeof($billet) ; ++$i)
            {
                ?>
                <button class="btnBilletCategory" value="<?php echo base64_encode(serialize($billet[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                    <p class="txt-btn"><?php if (isset($billet[$i])){echo $billet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
                </button>
                <?php
            }
            ?>
            </p>

</section>
<?php
end_page();
?>
