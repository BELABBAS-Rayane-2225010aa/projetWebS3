<?php
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
$controller->BilletArray();
$arrayBillet = $controller->getBilletArray();
?>
    <section class="formBox">
        <p>Pseudo :<?php echo $_SESSION['user']->getPseudo() ?></p>
        <button onclick="window.location.href='PseudoModifier.php';">Changer le pseudo</button>
        <p>E-mail :<?php echo $_SESSION['user']->getEmail() ?></p>
        <button onclick="window.location.href='EmailModifier.php';">Changer l'e-mail</button><br>
        <p>Date de création : 00/00/0000</p><br>
        <form action="Billet.php" method="post" id="billetform">Billet écrit:</form>
        <p><?php
            if ($arrayBillet === []){
                echo "Vous n'avez écrit aucun billet";
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
        <button onclick="window.location.href='PasswordModifier.php';">Changer le mdp</button>
    </section>
<?php
end_page();
?>