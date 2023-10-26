<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

use App\Controller\ResultatRechercheController;

$searchController = new ResultatRechercheController();?>
<h1 >Resultat de recherche </h1>
    <h2 >Billet</h2>
        <ul>
<?php
$searchController->getSearchBillet();
if($searchController->getSearchedBilletArray() !== null )
{
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
}
        ?>
<!--            <li></li>-->
        </ul>
<h2 >Commentaire</h2>
        <ul>
            <li></li>
        </ul>
<h2>Categorie</h2>
        <ul>
            <?php
            $searchController->getSearchCat();
            if($searchController->getSearchedCatArray() != null )
            {
                $searchedCat = $searchController->getSearchedCatArray();
                for ($i = 0 ; $i < sizeof($searchedCat) ; ++$i)
                {
                    ?>

                    <button class="btn-flex" value="<?php echo base64_encode(serialize($searchedCat[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                        <p class="txt-btn"><?php if (isset($searchedCat[$i])){echo $searchedCat[$i]->getLabel();}else{ echo 'erreur de chargement de la categorie';}?></p>
                    </button>
                    <?php
                }
            }
            ?>
<!--            <li></li>-->
        </ul>
<h2>User</h2>
        <ul>
            <?php
            $searchController->getSearchUser();
            if($searchController->getSearchedUserArray() != null )
            {
                $searchedUser = $searchController->getSearchedUserArray();
                for ($i = 0 ; $i < sizeof($searchedUser) ; ++$i)
                {
                    ?>

                    <button class="btn-flex" value="<?php echo base64_encode(serialize($searchedUser[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                        <p class="txt-btn"><?php if (isset($searchedUser[$i])){echo $searchedUser[$i]->getPseudo();}else{ echo 'erreur de chargement du User';}?></p>
                    </button>
                    <?php
                }
            }
            ?>
<!--            <li></li>-->
        </ul>


