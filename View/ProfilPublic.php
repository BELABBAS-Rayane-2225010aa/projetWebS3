<?php

use App\Repository\CategoryRepository;

require '../vendor/autoload.php';

require 'GestionPage.php' ?>
<?php
start_page('Billet');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body>
<?php
$active = "";
require 'HeaderMenu.php';//Charge le bar menu
if(!isset($_POST['userClique']))
{
    header('Location: ../index.php');
}
$serializedUser = $_POST['userClique'];
$userClique = unserialize(base64_decode($serializedUser));
if (!$userClique instanceof \App\Model\User) {
    echo 'La désérialisation a échoué';
}

$controller = new \App\Controller\ProfilController();
$controller->BilletArrayPublic();
$arrayBillet = $controller->getBilletArray();
$labelCatID = new CategoryRepository();;
?>
    <section id="profilpub">
        <p id="misenformep">Pseudo : <?php echo $userClique->getPseudo()?></p>
        <p id="misenformep">Date de création : <?php echo $userClique->getDateFirstCo()?></p><br>
        <form action="Billet.php" method="post" id="billetform">Billet écrit:</form>
        <p id="misenformep"><?php
            if ($arrayBillet === []){
                echo "Cette utilisateur n'a écrit aucun billet";
            }
            else {
                for ($i = 0; $i < sizeof($arrayBillet) ; ++$i){
                    ?>
                    <button id="btnprofil" value="<?php echo base64_encode(serialize($arrayBillet[$i]));?>" name="billetClique" form="billetform">
                        <p id="paragraphe"><?php if (isset($arrayBillet[$i])){echo $arrayBillet[$i]->getTitle().",".$arrayBillet[$i]->getDate().", Categorie : " .$labelCatID->catFromID($arrayBillet[$i]->getCategoryId())->getLabel();}else{ echo 'erreur de chargement du billet';}?></p>
                    </button><br>
                    <?php
                }
            }
            ?></p>
        <p >Commentaire écrit:</p>
        <p> -Commentaire1,Date1,Billet1
            <br>
            -Commentaire1,Date1,Billet1</p><br>
    </section>
<?php
end_page();
?>