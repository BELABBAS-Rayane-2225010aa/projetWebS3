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
        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn">Block Testtesttetstestest</p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn">Block 2</p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn">Block 3</p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn">Block 4</p>
        </button>

        <button class="btn-flex" onclick="window.location.href='View/Billet.php';">
      <span class="icone-btn">
      </span>
            <p class="txt-btn">Block 5</p>
        </button>


    </section>

<?php
end_page();
?>