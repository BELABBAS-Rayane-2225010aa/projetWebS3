<?php
require 'GestionPage.php';

start_page('Acceuil');
?>
    <body>
<?php
$active = 'index';
require 'headerMenu.php';
?>
    <section class="section-flex">
        <button class="btn-flex" onclick="window.location.href='View/Billet.php?id=<?php echo $_SESSION['BilletHome1']->getId(); ?>';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn"><?php if (isset($_SESSION['BilletHome1'])){echo $_SESSION['BilletHome1'];}?></p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn"><?php if (isset($_SESSION['BilletHome2'])){echo $_SESSION['BilletHome2'];}?></p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn"><?php if (isset($_SESSION['BilletHome3'])){echo $_SESSION['BilletHome3'];}?></p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn"><?php if (isset($_SESSION['BilletHome4'])){echo $_SESSION['BilletHome4'];}?></p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn"><?php if (isset($_SESSION['BilletHome5'])){echo $_SESSION['BilletHome5'];}?></p>
        </button>


    </section>

<?php
end_page();
?>