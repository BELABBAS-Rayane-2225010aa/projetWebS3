<?php

use App\Controller\HeaderMenuController;
require '../vendor/autoload.php';

$homeController = new HeaderMenuController();
$homeController->getAllCat();
$arrayCat = $homeController->getCatArray();
?>
<ul class="menu"><!--Menu de haut de page qui est prèsent sur toute les page-->
    <li><a <?php if ($active === 'index'){echo 'class=active';};?> href="../index.php">Acceuil</a></li>
    <bouton class="dropdown" ><a  class="dropbtn"  <?php if ($active === 'categorie'){echo 'class=active';};?>>Categorie ▾</a>
        <div class="dropdown-content">
            <form action="Category.php" method="post" id="catform"></form>
            <?php
            for ($i = 0 ; $i < sizeof($arrayCat) ; ++$i)
            {
            ?>
                <button class="deroulant" value="<?php echo base64_encode(serialize($arrayCat[$i]));?>" name="catClique" form="catform">
                <span>
                </span>
                    <p class="txt-btn"><?php if (isset($arrayCat[$i])){echo $arrayCat[$i]->getLabel();}else{ echo 'erreur de chargement du billet';}?></p>
                </button>
<!--            <a href="Category.php">--><?php //echo $arrayCat[$i]["LABEL"]?><!--</a>-->
            <?php
            }
            ?>
        </div>
    </bouton>
    <li style="float:right"><a <?php if ($active === 'about'){echo 'class=active';}?> href="/View/about.php">A propos</a></li>
    <?php
    //Vérifie si l'utilisateur est connecté et change les bouton du menu en fonction.
    if(!isset($_SESSION['suid']))
    {
    ?>
        <li style="float:right"><a <?php if ($active === 'connexion'){echo 'class=active';} ?> href="/View/Login.php">Se connecter</a></li>
        <li style="float:right"><a <?php if ($active === 'cree_compte'){echo 'class=active';} ?> href="/View/SignUp.php">Cree un compte</a></li>
    <?php
    }
    else
    {
        if ($_SESSION['user']->getIsAdmin() == 1){
            ?>
            <li style="float:right"><a <?php if ($active === 'admin'){echo 'class=active';} ?> href="/View/AdminPage.php">Admin</a></li>
        <?php
        }
    ?>
        <li style="float:right"><a <?php if ($active === 'deconexion'){echo 'class=active';} ?> href="/View/Deconexion.php">Déconexion</a></li>
        <li style="float:right"><a <?php if ($active === 'profil'){echo 'class=active';} ?> href="/View/Profil.php">Profil</a></li>
    <?php
    }
    ?>
    <form style="float:right" class="search" action="ResultatRecherche.php" method="post">
        <input type="text" id="searchInput" name="TexteRecherche" class="searchinput" placeholder="Recherche..." />
<!--        <input type="submit" value="recherche" name="recherche">-->
        <label for="searchInput" class="searchbutton">
            <span  type="submit"><img id="icon" src="../View/image/Iconsearch.png" alt="icon de recherche"/></span>
        </label>
    </form><!-- Fin du formulaire de recherche -->
</ul>

