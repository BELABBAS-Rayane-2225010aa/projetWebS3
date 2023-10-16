<?php
require 'GestionPage.php';

start_page('Acceuil');

?>
    <body>
<?php
$active = 'index';
require 'headerMenu.php';
var_dump($_SESSION);
?>
    <section class="section-flex">
        <form action="Billet.php" method="get" id="billetform"/>
        <button class="btn-flex" value="<?php echo $_SESSION['BilletHome1'];?>" name="BilletID" form="billetform">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (!isset($_SESSION['BilletHome1'])){echo $_SESSION['BilletHome1'];}else{echo 'Block Testtesttetstestest';}?></p>
        </button>

        <button class="btn-flex" value="<?php echo $_SESSION['BilletHome2'];?>" name="BilletID" form="billetform">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (isset($_SESSION['BilletHome2'])){echo $_SESSION['BilletHome2'];}?></p>
        </button>

        <button class="btn-flex" value="<?php echo $_SESSION['BilletHome3'];?>" name="BilletID" form="billetform">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (isset($_SESSION['BilletHome3'])){echo $_SESSION['BilletHome3'];}?></p>
        </button>

        <button class="btn-flex" value="<?php echo $_SESSION['BilletHome4'];?>" name="BilletID" form="billetform">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (isset($_SESSION['BilletHome4'])){echo $_SESSION['BilletHome4'];}?></p>
        </button>

        <button class="btn-flex" value="<?php echo $_SESSION['BilletHome5'];?>" name="BilletID" form="billetform">
            <span class="icone-btn">
            </span>
                <p class="txt-btn"><?php if (isset($_SESSION['BilletHome5'])){echo $_SESSION['BilletHome5'];}?></p>
        </button>
    </section>

<?php
end_page();
?>