<ul class="menu"><!--Menu de haut de page qui est prèsent sur toute les page-->
    <div class="blur"></div>
    <li><a <?php if ($active === 'index'){echo 'class=active';};?> href="../index.php">Acceuil</a></li>
    <li class="dropdown" >
        <a  class="dropbtn"  <?php if ($active === 'categorie'){echo 'class=active';};?> href="/View/categorie.php">Categorie</a>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </li>
    <li><a <?php if ($active === 'contact'){echo 'class=active';};?> href="/View/contact.php">Contact</a></li>
    <li style="float:right"><a <?php if ($active === 'about'){echo 'class=active';}?> href="/View/about.php">About</a></li>
    <li style="float:right"><a <?php if ($active === 'connection'){echo 'class=active';}?> href="/View/about.php">Se connecter</a></li>
    <li style="float:right"><a <?php if ($active === 'cree_compte'){echo 'class=active';}?> href="/View/about.php">Cree un compte</a></li>
</ul>

