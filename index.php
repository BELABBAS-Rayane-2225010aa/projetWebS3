<?php require 'View/Page/startpage.php' ?>
<?php
start_page('Acceuil');
?>
<body>
<?php $active = 'index';
require 'View/Page/headerMenu.php' ?>
<section class="section-flex">
    <button class="btn-flex" onclick="window.location.href='View/Page/Billet.php';">
      <span class="icone-btn">
      </span>
        <p class="txt-btn">Block Testtesttetstestest</p>
    </button>

    <button class="btn-flex" onclick="window.location.href='View/Page/Billet.php';">
      <span class="icone-btn">
      </span>
        <p class="txt-btn">Block 2</p>
    </button>

    <button class="btn-flex" onclick="window.location.href='View/Page/Billet.php';">
      <span class="icone-btn">
      </span>
        <p class="txt-btn">Block 3</p>
    </button>

    <button class="btn-flex" onclick="window.location.href='View/Page/Billet.php';">
      <span class="icone-btn">
      </span>
        <p class="txt-btn">Block 4</p>
    </button>

    <button class="btn-flex" onclick="window.location.href='View/Page/Billet.php';">
      <span class="icone-btn">
      </span>
        <p class="txt-btn">Block 5</p>
    </button>


</section>
<?php require 'View/Page/endpage.php' ?>
<?php
end_page();
?>
</body>
</html>