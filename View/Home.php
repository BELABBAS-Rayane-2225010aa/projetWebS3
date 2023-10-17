<?php
require '../vendor/autoload.php';
require 'GestionPage.php';

use App\Model\Billet;

start_page('Acceuil');

?>
    <body>
<?php
$active = 'index';
require 'headerMenu.php';
?>
    <section class="section-flex">
        <form action="Billet.php" method="post" id="billetform"></form>
        <?php
        for ($i = 0 ; $i < 5 ; ++$i)
        {
        ?>
            <button class="btn-flex" value="<?php echo  htmlspecialchars(serialize($_SESSION['cinqBillet'][$i]));?>" name="billetClique" form="billetform">
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