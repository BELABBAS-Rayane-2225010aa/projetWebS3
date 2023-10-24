<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

use App\Controller\ResultatRechercheController;

$searchController = new ResultatRechercheController();
$searchController->getSearchBillet();
$searchedBillet = $searchController->getSearchedBilletArray();
        for ($i = 0 ; $i < sizeof($searchedBillet) ; ++$i)
        {
            ?>

            <button class="btn-flex" value="<?php echo base64_encode(serialize($searchedBillet[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                <p class="txt-btn"><?php if (isset($searchedBillet[$i])){echo $searchedBillet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
            </button>
            <?php
        }