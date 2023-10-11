<ul class="menu"> <!--Menu de haut de page qui est prèsent sur toute les page-->
    <li><a <?php if ($active === 'index'){echo 'class=active';};?> href="../index.php">Acceuil</a></li>
    <li><a <?php if ($active === 'categorie'){echo 'class=active';};?> href="/View/categorie.php">Categorie</a></li>
    <li><a <?php if ($active === 'contact'){echo 'class=active';};?> href="/View/contact.php">Contact</a></li>
    <li style="float:right"><a <?php if ($active === 'about'){echo 'class=active';}?> href="/View/about.php">About</a></li>
    <li style="float:right"><a <?php if ($active === 'connection'){echo 'class=active';}?> href="/View/Login.php">Se connecter</a></li>
    <li style="float:right"><a <?php if ($active === 'cree_compte'){echo 'class=active';}?> href="/View/SignUp.php">Cree un compte</a></li>
</ul>
