<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Categorie');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>
<body>
<?php $active = 'Categorie';
require 'HeaderMenu.php';//Charge le bar menu
if(!isset($_POST['catClique']))
{
    header('Location: ../index.php');
}
$serializedCat = $_POST['catClique'];
$catClique = unserialize(base64_decode($serializedCat));
if (!$catClique instanceof \App\Model\Category) {
    echo 'La désérialisation a échoué';
}
?>
<section class="section-flex">
    <form action="" method="post" id=""></form>
        <button class="btnBillet" value="categorie" name="categoryClick" form="">
                <span class="icone-btn">
                </span>
            <p class="txt-btn">Les Billet Présent Dans la Catégorie : "<?php echo $catClique->getLabel() ?>"</p>
            <p class="txt-btn"> Description : <?php echo $catClique->getDescription() ?> </p>

        </button>
</section>
<?php
end_page();
?>
