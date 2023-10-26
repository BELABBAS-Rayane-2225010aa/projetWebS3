<?php
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
?>
    <section class="formBox">
        <p>Pseudo : <?php echo $userClique->getPseudo()?></p>
        <p>Date de création : <?php echo $userClique->getDateFirstCo()?></p><br>
        <form action="Billet.php" method="post" id="billetform">Billet écrit:</form>
        <p><?php
            if ($arrayBillet === []){
                echo "Cette utilisateur n'a écrit aucun billet";
            }
            else {
                for ($i = 0; $i < sizeof($arrayBillet) ; ++$i){
                    ?>
                    <button value="<?php echo base64_encode(serialize($arrayBillet[$i]));?>" name="billetClique" form="billetform">
                        <p><?php if (isset($arrayBillet[$i])){echo $arrayBillet[$i]->getTitle().",".$arrayBillet[$i]->getDate().", TODO : mettre les categories";}else{ echo 'erreur de chargement du billet';}?></p>
                    </button><br>
                    <?php
                }
            }
            ?></p>
        <p>Commentaire écrit:</p>
        <p>-Commentaire1,Date1,Billet1
            -Commentaire1,Date1,Billet1</p><br>
    </section>
<?php
end_page();
?>