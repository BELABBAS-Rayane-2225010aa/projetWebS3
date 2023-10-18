<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

use App\Controller\HomeController;

$homeController = new HomeController();
$homeController->get5Billet();
$cinqBillet = $homeController->getBilletArray();

start_page('Acceuil');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.

?>
    <body>
<?php
$active = 'index';
require 'headerMenu.php';//Charge le bar menu
?>
    <section class="section-flex"><!--affiche les 5 dernier billet créé-->
        <form action="Billet.php" method="post" id="billetform"></form>
        <?php
        for ($i = 0 ; $i < 5 ; ++$i)
        {
        ?>
            <button class="btn-flex" value="<?php echo base64_encode(serialize($cinqBillet[$i]));?>" name="billetClique" form="billetform">
                <span class="icone-btn">
                </span>
                    <p class="txt-btn"><?php if (isset($cinqBillet[$i])){echo $cinqBillet[$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
            </button>
        <?php
        }
        ?>
    </section>

<?php
end_page();
?>