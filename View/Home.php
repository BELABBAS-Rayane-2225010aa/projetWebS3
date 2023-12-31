<?php
require '../vendor/autoload.php';

require 'GestionPage.php';

use App\Controller\HomeController;

$homeController = new HomeController();
$homeController->get5Billet();
$cinqBillet = $homeController->getBilletArray();
$homeController->getConnected();
$connectedArray = $homeController->getConnectedArray();


start_page('Acceuil');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
    <body>
<?php
$active = 'index';
require 'HeaderMenu.php';//Charge le bar menu
?>
    <section class="sectionflex"><!--affiche les 5 dernier billet créé-->
        <form action="Billet.php" method="post" id="billetform"></form>
        <?php
        for ($i = 0 ; $i < 5 ; ++$i)
        {
        ?>
            <button class="btn-flex" value="<?php echo base64_encode(serialize($cinqBillet[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                   <?php if (isset($cinqBillet[$i])){echo $cinqBillet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?>
            </button>
        <?php
        }
        ?>
    </section>
<div>
    <section>
        <form class="util" id="connectedform" action="ProfilPublic.php" method="post">
            <p>Utilisateurs:</p>
            <?php
            if (isset($connectedArray)){
                for ($i = 0 ; $i < sizeof($connectedArray) ; ++$i){
                    if ($i%5===0){ echo "<br>";}
            ?>
                    <button value="<?php echo base64_encode(serialize($connectedArray[$i]));?>" name="userClique" form="connectedform">
                        <?php echo $connectedArray[$i]->getPseudo();?>
                    </button>
            <?php
                }
            }
            ?>
        </form>
    </section>
</div>
    <p style="color: red"><?php if (isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></p>
<?php
end_page();
?>