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
    <button onclick="BoutonAffichageCategorie()" class="buttonCategory"><i class="fa-solid fa-bars"></i></button><!--Présent qu'en mode portable sert a ameliorer la lisibiliter du billet-->
    <aside id="CategorieID" class="category"><!--affiche les categories du billet-->
        <h2>Categories : <?php echo $cat->getLabel() ?></h2>
        <h3> Description </h3>
        <p><?php echo $cat->getDescription() ?></p>
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
                <button class="btnCommentCategory" value="<?php echo $serializedBillet;?>" name="billetClique" form="billetModifierForm">Modifier</button>
            <?php }
                if($billetClique->getAuthorId() === $_SESSION['user']->getUserId() || $_SESSION['user']->getIsAdmin()){ ?>
                <form action="../index.php" method="post" id="billetSupprimerForm"></form>
                <button class="btnCommentCategory" value="<?php echo $billetClique->getBilletId();?>" name="supBillet" form="billetSupprimerForm">Supprimer</button>
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
            <textarea id="createComment" name="texteComment" rows="2" cols="60" wrap="hard" ></textarea>
            <input class="btnCommentCategory" type="submit" name="addComment" <span class="fa fa-send"> </span>

        </form>
        <br>
    <?php } ?>

    <!--Affichage des commentaires-->
    <form id="CommentModif" action="Billet.php" method="post"></form>
    <form id="CommentAction" action="../index.php" method="post" class="Comments">
        <?php
        if (sizeof($arrayComment)!=0) {
            for ($i = 0 ; $i < sizeof($arrayComment) ; ++$i)
            {
                $isImportante = $arrayComment[$i]->isImportante();
                $commentTexte = $arrayComment[$i]->getText();
                $commentAuteur = $pseudoCommentAuteur->getPseudoFromID($arrayComment[$i]->getAuthor());?>
                    <label for="comment"> Commentaire de <?php echo $commentAuteur->getPseudo() ?> :</label>
                <?php
                if (isset($_POST['CommentModifEtat']) && $_POST['CommentModifEtat']==$arrayComment[$i]->getCommentId()){ ?>
                    <textarea form="CommentAction" id="comment" name="texteModif<?php echo $arrayComment[$i]->getCommentId() ?>"><?php echo $commentTexte ?>
                    </textarea>
                <?php
                }
                else {?>
                    <p form="CommentAction" id="comment" name="texteModif<?php echo $arrayComment[$i]->getCommentId() ?>"><?php echo $commentTexte ?>
                    </p>
                <?php
                }
                if (isset($_SESSION['suid'])){
                    if ($_SESSION['user']->getUserId() === $billetClique->getAuthorId()){
                        if ($isImportante === 0){
                    ?>
                            <button class="btnupvote" form="CommentAction" name="makeImportante" value="<?php echo $arrayComment[$i]->getCommentId()?>"> <i class="fa-solid fa-arrow-up"></i></i></button>
                    <?php
                        }
                        else {
                    ?>
                            <button class="btndownvote" form="CommentAction" name="unMakeImportante" value="<?php echo $arrayComment[$i]->getCommentId()?>"><i class="fa-solid fa-arrow-down"></i></button>
                    <?php
                        }
                    }
                ?>
                <?php
                    if ($_SESSION['user']->getIsAdmin() || $_SESSION['user']->getUserId()===$arrayComment[$i]->getAuthor()) {?>
                        <button class="btnpoubelle" form="CommentAction" name="DelComment" value="<?php echo $arrayComment[$i]->getCommentId()?>"><i class="fa-solid fa-trash"></button>
                        <?php
                        if ($_SESSION['user']->getUserId()===$arrayComment[$i]->getAuthor()) {
                            if(isset($_POST['CommentModifEtat'])){?>
                                <button form="CommentAction" title="Ecriver dans la zone de texte puis cliquez pour modifier" name="CommentModifier" value="<?php echo $arrayComment[$i]->getCommentId()?>">Sauvegarder les modifications</button>
                                <button form="CommentModif" name="CommentModifierCancel">Annuler</button>
                            <?php
                            }
                            else{ ?>
                            <button class="btnmodif" form="CommentModif" name="CommentModifEtat" value="<?php echo $arrayComment[$i]->getCommentId()?>"><i class="fa-solid fa-pen"></button>
                            <?php
                            }
                        }
                    }
                }?>
            <br>
            <?php
            }
        }
        ?>
        <p style="color: red"><?php if (isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
    </form>
    <br>
<?php
end_page();
?>
