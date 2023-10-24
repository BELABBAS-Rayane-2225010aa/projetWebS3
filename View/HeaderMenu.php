<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<ul class="menu"><!--Menu de haut de page qui est prèsent sur toute les page-->
    <li><a <?php if ($active === 'index'){echo 'class=active';};?> href="../index.php">Acceuil</a></li>
    <bouton class="dropdown" > <i class="fa fa-caret-down"></i><a  class="dropbtn"  <?php if ($active === 'categorie'){echo 'class=active';};?>>Categorie</a>
        <div class="dropdown-content">
           <!-- <?php/*
            for ($i=0;$i<$nbcategorie;++$i){
            */?>
                <a href="#"><?php /*echo base64_encode(serialize($listCategorie[$i]));*/?></a>
            <?php/*
            }
            */?> -->
        </div>
    </bouton>
    <li><a <?php if ($active === 'Billet'){echo 'class=active';};?> href="/View/BilletList.php">Billet</a></li>
    <li style="float:right"><a <?php if ($active === 'about'){echo 'class=active';}?> href="/View/about.php">About</a></li>
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
        <li style="float:right"><a <?php if ($active === 'cree_poste'){echo 'class=active';} ?> href="/View/PostBillet.php">Crée un poste</a></li>
    <?php
    }
    ?>

    <form style="float:right" class="search" action="ResultatRecherche.php" method="post">
        <input type="text" id="searchInput" name="TexteRecherche" class="searchinput" placeholder="Recherche..." />
<!--        <input type="submit" value="recherche" name="recherche">-->
        <label for="searchInput" class="searchbutton">
            <span class="fa fa-search" type="submit"> </span>
        </label>
    </form><!-- Fin du formulaire de recherche -->
</ul>

