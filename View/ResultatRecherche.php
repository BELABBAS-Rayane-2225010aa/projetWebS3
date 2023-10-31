<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

use App\Controller\ResultatRechercheController;

start_page('Recherche');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php
$active = '';
require 'HeaderMenu.php';//Charge le bar menu
$searchController = new ResultatRechercheController();
?>
<section id="reche">
<h1  id="misenforme1">Resultat de recherche </h1>
    <h2  id="misenforme">Billet</h2>
        <ul id="palier">
            <form action="Billet.php" method="post" id="billetform">
            <?php
            $searchController->getSearchBillet();
            if($searchController->getSearchedBilletArray() !== null )
            {
                $searchedBillet = $searchController->getSearchedBilletArray();
                for ($i = 0 ; $i < sizeof($searchedBillet) ; ++$i)
                {
                ?>
                <button id="btnflexbillet" value="<?php echo base64_encode(serialize($searchedBillet[$i]));?>" name="billetClique" form="billetform">
                    <span id="icone-btn">
                    </span>
                    <p class="txt-btn"><?php if (isset($searchedBillet[$i])){echo $searchedBillet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
                </button>
                <?php
                }
            }
            ?>
            </form>
<!--            <li></li>-->
        </ul>
<h2 id="misenforme">Commentaire</h2>
        <ul id="palier">
            <form action="Billet.php" method="post" id="billetform">
            <?php
            $searchController->getSearchComment();
            if($searchController->getSearchedCommentArray() != null )
            {
                $searchedComment = $searchController->getSearchedCommentArray();
                for ($i = 0 ; $i < sizeof($searchedComment) ; ++$i)
                {
                    ?>

                    <button id="btnflexbillet" value="<?php echo base64_encode(serialize($searchedComment[$i]));?>" name="billetClique" form="billetform">
                <span id="icone-btn">
                </span>
                        <p class="txt-btn"><?php if (isset($searchedComment[$i])){echo $searchedComment[$i]->getLabel();}else{ echo 'erreur de chargement du commentaire';}?></p>
                    </button>
                    <?php
                }
            }
            ?>
            </form>
<!--            <li></li>-->
        </ul>
<h2  id="misenforme" >Categorie</h2>
        <ul id="palier">
            <form action="Category.php" method="post" id="catform">
            <?php
            $searchController->getSearchCat();
            if($searchController->getSearchedCatArray() != null )
            {
                $searchedCat = $searchController->getSearchedCatArray();
                for ($i = 0 ; $i < sizeof($searchedCat) ; ++$i)
                {
                    ?>
                    <button id="btnflexbillet" value="<?php echo base64_encode(serialize($searchedCat[$i]));?>" name="catClique" form="catform">
                <span id="icone-btn">
                </span>
                        <p class="txt-btn"><?php if (isset($searchedCat[$i])){echo $searchedCat[$i]->getLabel();}else{ echo 'erreur de chargement de la categorie';}?></p>
                    </button>
                    <?php
                }
            }
            ?>
            </form>
<!--            <li></li>-->
        </ul>
<h2  id="misenforme">User</h2>
        <ul id="palier">
            <form action="ProfilPublic.php" method="post" id="connectedform">
            <?php
            $searchController->getSearchUser();
            if($searchController->getSearchedUserArray() != null )
            {
                $searchedUser = $searchController->getSearchedUserArray();
                for ($i = 0 ; $i < sizeof($searchedUser) ; ++$i)
                {
                    ?>

                    <button id="btnflexbillet" value="<?php echo base64_encode(serialize($searchedUser[$i]));?>" name="userClique" form="btnflexbillet">
                <span id="icone-btn">
                </span>
                        <p class="txt-btn"><?php if (isset($searchedUser[$i])){echo $searchedUser[$i]->getPseudo();}else{ echo 'erreur de chargement du User';}?></p>
                    </button>
                    <?php
                }
            }
            ?>
            </form>
<!--            <li></li>-->
        </ul>
</section>


