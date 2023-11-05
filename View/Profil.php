<?php

use App\Repository\CategoryRepository;

require '../vendor/autoload.php';

require 'GestionPage.php';
if(!isset($_SESSION['suid']))
{
    header('Location: ../index.php');
}
start_page('Profil');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
$active = 'profil';
require 'HeaderMenu.php';//Charge le bar menu

$controller = new \App\Controller\ProfilController();
$controller->BilletArrayPrivate();
$controller->CommentArrayPrivate();
$arrayBillet = $controller->getBilletArray();
$arrayComment = $controller->getCommentArray();
$labelCatID = new CategoryRepository();;
?>
    <section id="profilpub">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <button id="btnprofil" onclick="window.location.href='PseudoModifier.php';">Changer le pseudo</button>
        <p id="misenformep"></p>
        <p >E-mail :<?php echo $_SESSION['user']->getEmail() ?></p>
        <button id="btnprofil" onclick="window.location.href='EmailModifier.php';">Changer l'e-mail</button>
        <p id="misenformep" >Date de création : <?php echo $_SESSION['user']->getDateFirstCo()?></p><br>
        <form action="Billet.php" method="post" id="billetform">Billet écrit:</form>
        <p id="misenformep"><?php
            if ($arrayBillet === []){
                echo "Vous n'avez écrit aucun billet";
            }
            else {
                for ($i = 0; $i < sizeof($arrayBillet) ; ++$i){
            ?>
                    <button id="btnprofil" value="<?php echo base64_encode(serialize($arrayBillet[$i]));?>" name="billetClique" form="billetform">
                        <p><?php if (isset($arrayBillet[$i])){echo $arrayBillet[$i]->getTitle().",".$arrayBillet[$i]->getDate().", Categorie : ".$labelCatID->catFromID($arrayBillet[$i]->getCategoryId())->getLabel();}else{ echo 'erreur de chargement du billet';}?></p>
                    </button><br>
            <?php
                }
            }
            ?></p>
        <p>Commentaire écrit:</p>
        <p id="misenformep"><?php
            if ($arrayComment === []){
                echo "Vous n'avez écrit aucun commentaire";
            }
            else {
                for ($i = 0; $i < sizeof($arrayComment) ; ++$i){
                    ?>
                    <button id="btnprofil" value="<?php $billetId = $arrayComment[$i]->getBillet(); $billetRepo = new \App\Repository\BilletRepository(); echo base64_encode(serialize($billetRepo->getBilletFromId($billetId)));?>" name="billetClique" form="billetform">
                        <p ><?php if (isset($arrayComment[$i])){echo $arrayComment[$i]->getText().",".$arrayComment[$i]->getDate().", Billet : ".$billetRepo->getBilletFromId($billetId)->getTitle();}else{ echo 'erreur de chargement du comment';}?></p>
                    </button><br>
                    <?php
                }
            }
            ?></p>
        <button id="btnprofil" onclick="window.location.href='PasswordModifier.php';">Changer le mdp</button>
        <button id="btnprofil" onclick="if (confirm('Etes-vous sûr de vouloir supprimer votre compte ?')) {window.location.href='DeleteProfil.php'}">Supprimer le compte</button>
    </section>
<?php
end_page();
?>