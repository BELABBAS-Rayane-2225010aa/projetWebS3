<?php
session_start();
function start_page($title): void
{
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum "/>
    <link rel="icon" href="../View/image/favicon.ico" type="image/x-icon" />
    <title><?php echo $title; ?></title>
    <link id="theme" rel="stylesheet" href="../View/Style/style.css" media="all and (orientation: landscape)"> <!--css pour ecran en paysage-->
    <link id="themeP" rel="stylesheet" href="../View/Style/stylePortable.css" media="all and (orientation: portrait)"><!--css pour telephone et tout appareille quand la page est sur un ecran en portrait-->
</head>
<?php
}
?>

<?php function end_page(): void
{
    if(isset($_SESSION['suid'])) { ?>
        <button class="btnCreator" value="crée billet" name="billetCreator" form="billetform" onclick="window.location.href='../View/PostBillet.php'">crée billet</button>
<?php } ?>

    <footer>
         <small>CC-by 2023-2024 taverneDeBille.alwaysdata.net</small>
    </footer>

</html>
<?php
}
?>
