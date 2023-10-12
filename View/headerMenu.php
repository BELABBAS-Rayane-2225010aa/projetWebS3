<ul class="menu"><!--Menu de haut de page qui est prèsent sur toute les page-->
    <li><a <?php if ($active === 'index'){echo 'class=active';};?> href="../index.php">Acceuil</a></li>
    <bouton class="dropdown" > <i class="fa fa-caret-down"></i><a  class="dropbtn"  <?php if ($active === 'categorie'){echo 'class=active';};?> >Categorie</a>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </bouton>
    <li><a <?php if ($active === 'contact'){echo 'class=active';};?> href="/View/contact.php">Contact</a></li>
    <li style="float:right"><a <?php if ($active === 'about'){echo 'class=active';}?> href="/View/about.php">About</a></li>
    <?php
    if(!isset($_SESSION['suid']))
    {
    ?>
        <li style="float:right"><a <?php if ($active === 'connection'){echo 'class=active';} ?> href="/View/Login.php">Se connecter</a></li>
        <li style="float:right"><a <?php if ($active === 'cree_compte'){echo 'class=active';} ?> href="/View/SignUp.php">Cree un compte</a></li>
    <?php
    }
    else
    {?>
        <li style="float:right"><a <?php if ($active === 'deco'){echo 'class=active';} ?> href="/View/Deconexion.php">Deconexion</a></li>
        <li style="float:right"><a <?php if ($active === 'profil'){echo 'class=active';} ?> href="/View/Profil.php">Profil</a></li>
    <?php
    }
    ?>
</ul>

