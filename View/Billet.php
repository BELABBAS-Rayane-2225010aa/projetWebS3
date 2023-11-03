<?php
require '../vendor/autoload.php';

require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Billet';
require 'HeaderMenu.php';//Charge le bar menu


use App\Controller\SetSession;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Model\Comment;

if(!isset($_POST['billetClique']) && !isset($_SESSION['lastBillet']))
{
    header('Location: ../index.php');
}
if (isset($_POST['billetClique'])) {
    $serializedBillet = $_POST['billetClique'];
    $session = new SetSession();
    $session->setLastBilletClique($serializedBillet);
}
else {
    $serializedBillet = $_SESSION['lastBillet'];
}

$billetClique = unserialize(base64_decode($serializedBillet));
if (!$billetClique instanceof \App\Model\Billet) {
    echo 'La désérialisation a échoué';
}
$commentaire = new CommentRepository();
$arrayComment = $commentaire->getCommentByBillet($billetClique->getBilletId());
$pseudoCommentAuteur = new UserRepository();
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

    <section class="Billet"><!--affiche les comentaires du billet-->
        <h2><?php echo $billetClique->getTitle()?></h2>
        <p><?php if(!empty($billetClique->getMsg())){echo $billetClique->getMsg();}else{echo 'ERROR Le message est vide ERROR';}?></p>
        <h3>Auteur : <?php echo $auteur->getPseudo() ?></h3>
        <?php
        if (isset($_SESSION['user'])){
            if ($billetClique->getAuthorId() === $_SESSION['user']->getUserId()){
                ?>
                <form action="BilletModifier.php" method="post" id="billetModifierForm"></form>
                <button value="<?php echo $serializedBillet;?>" name="billetClique" form="billetModifierForm">Modifier</button>
                <?php
            }
        }?>
        <p>Date : <?php echo $billetClique->getDate() ?></p>
    </section>
    <br>
    <?php
    if(isset($_SESSION['suid'])) { ?>
        <form action="../index.php" method="post" class="Comments">
            <input name="userID" type="hidden" value="<?php echo $_SESSION['user']->getUserId()?>"/>
            <input name="billetID" type="hidden" value="<?php echo $billetClique->getBilletId()?>"/>
            <input name="billetComment" type="hidden" value="<?php echo base64_encode(serialize($billetClique))?>"/>
            <label for="createComment">Ecrivez un commentaire</label>
            <textarea id="createComment" name="texteComment" rows="1" cols="40" wrap="hard" ></textarea>
            <input class="btnCommentCategory" type="submit" name="addComment" <span class="fa fa-send"> </span>

        </form>
        <br>
    <?php } ?>

    <!--Affichage des commentaires-->
    <form id="CommentAction" action="../index.php" method="post" class="Comments">
    <?php
    if (sizeof($arrayComment)!=0) {
        for ($i = 0 ; $i < sizeof($arrayComment) ; ++$i)
        {
            $commentTexte = $arrayComment[$i]->getText();
            $commentAuteur = $pseudoCommentAuteur->getPseudoFromID($arrayComment[$i]->getAuthor());
            ?>
            <label for="comment"> Commentaire de <?php echo $commentAuteur->getPseudo() ?> </label>
            <textarea id="comment" wrap="hard" rows="5" cols="80" readonly>
                <?php echo $commentTexte ?>
            </textarea>
            <?php
            if ($_SESSION['user']->getUserId()===$arrayComment[$i]->getAuthor()) {?>
                <button form="CommentAction" name="DelComment" value="<?php echo $arrayComment[$i]->getCommentId()?>">Supprimer Commentaire</button>
            <?php
            }
            ?>
            <br>
            <?php
        }
    }
    ?>
    </form>
    <br>


<?php
end_page();
?>
