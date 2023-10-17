<?php
require '../vendor/autoload.php';
require 'GestionPage.php' ?>
<?php
start_page('Billet');
?>
<body>
<?php $active = 'Billet';
require 'headerMenu.php';
if(!isset($_POST['billetClique']))
{
    header('Location: ../index.php');
}
$billetClique = unserialize($_POST['billetClique']);
if(!$billetClique)
{
    var_dump($billetClique);
    // TODO: EXCEPTION si unserilalize ne marche pas
}

?>
    <SCRIPT>
    function BoutonAffichageCategorie() { //affiche/cache la barre des categorie
        var x = document.getElementById('CategorieID');
        var con = document.getElementById('commentID');
        if (x.style.display != 'none') {
            x.style.display = 'none';
            con.style.marginLeft = '0.3vh'
        } else {
            x.style.display = 'block';
            con.style.marginLeft = '14.5vh'
        }
    }
    </SCRIPT>
    <button onclick="BoutonAffichageCategorie()" class="buttonCategorie">teste</button>
    <aside id="CategorieID" class="categories">
        <h2>Categories ID : <?php echo $billetClique->getCategoryId() ?></h2>
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    </aside>

    <section id="commentID" class="comments">
        <h2><?php echo $billetClique->getTitle()?></h2>
        <p><?php if(!empty($billetClique->getMsg())){echo $billetClique->getMsg();}else{echo 'ERROR Le message est vide ERROR';}?></p>
        <h3>AuteurID : <?php echo $billetClique->getAuthorId() ?></h3>
        <p>Date : <?php echo $billetClique->getDate() ?></p>
    </section>
<?php
end_page();
?>
