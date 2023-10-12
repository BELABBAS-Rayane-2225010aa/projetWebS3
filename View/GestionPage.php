<?php
session_start();
function start_page($title): void
{
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="../View/image/favicon.ico" type="image/x-icon" />
    <title><?php echo $title; ?></title>
    <link id="theme" rel="stylesheet" href="../View/Style/style.css" media="all and (orientation: landscape)">
    <link id="themeP" rel="stylesheet" href="../View/Style/stylePortable.css" media="all and (orientation: portrait)">
</head>
<?php
}
?>

<?php function end_page(): void
{
    ?>
    <footer>
        <small>Copyright @ 2099 D20.com. tout droit tanque ca tourne pas.</small>
    </footer>
</body>
</html>
<?php
}
?>
