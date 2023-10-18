<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

use App\Model\Billet;

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
            <button class="btn-flex" value="<?php echo  htmlspecialchars(serialize($_SESSION['cinqBillet'][$i]));?>" name="billetClique" form="billetform"><!--Chaque billet a un bouton dedié-->
                <span class="icone-btn">
                </span>
                    <p class="txt-btn"><?php if (isset($_SESSION['cinqBillet'][$i])){echo $_SESSION['cinqBillet'][$i]->getTitle();}else{ echo 'erreur de chargement du billet';}?></p>
            </button>
        <?php
        }
        ?>
    </section>

<?php
end_page();
?>