<?php
require '../vendor/autoload.php';

require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Billet';
require 'HeaderMenu.php';//Charge le bar menu


use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

if(!isset($_POST['billetClique']))
{
    header('Location: ../index.php');
}
$serializedBillet = $_POST['billetClique'];
$billetClique = unserialize(base64_decode($serializedBillet));
if (!$billetClique instanceof \App\Model\Billet) {
    echo 'La désérialisation a échoué';
}
$labelCatID = new CategoryRepository();
$cat = $labelCatID->catFromID($billetClique->getCategoryId());
$pseudoAuteur = new UserRepository();
$auteur = $pseudoAuteur->getPseudoFromID($billetClique->getAuthorId());
?>
<script src="Bouton.js"></script>
    <button onclick="BoutonAffichageCategorie()" class="buttonCategory"><img src="../View/image/BtnCategorie.ico" /></button><!--Présent qu'en mode portable sert a ameliorer la lisibiliter du billet-->
    <aside id="CategorieID" class="category"><!--affiche les categories du billet-->
        <h2>Categories : <?php echo $cat->getLabel() ?></h2>
        <h3> Description </h3>
        <p><?php echo $cat->getDescription() ?></p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </aside>

    <section id="commentID" class="comments"><!--affiche les comentaires du billet-->
        <h2><?php echo $billetClique->getTitle()?></h2>
        <p><?php if(!empty($billetClique->getMsg())){echo $billetClique->getMsg();}else{echo 'ERROR Le message est vide ERROR';}?></p>
        <h3>Auteur : <?php echo $auteur->getPseudo() ?></h3>
        <?php
        if (isset($_SESSION['user'])){
            if ($billetClique->getAuthorId() === $_SESSION['user']->getUserId()){
                ?>
                <form action="BilletModifier.php" method="post" id="billetModifierForm"></form>
                <button value="<?php echo $_POST['billetClique'];?>" name="billetClique" form="billetModifierForm">Modifier</button>
                <?php
            }
        }?>
        <p>Date : <?php echo $billetClique->getDate() ?></p>
    </section>
<?php
end_page();
?>
