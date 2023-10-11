<?php
namespace App;

require 'vendor\autoload.php';

use App\Controller\LoginController;

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'action') {
        var_dump('coucou');
        $controller = new LoginController();
        var_dump('coucou2');
        $controller->getLogin();
    } else {
        echo 'ERREUR : t nul';
    }
}

require 'View\startpage.php';
?>


<?php
start_page('Acceuil');
?>
<body>
<?php $active = 'index';
require 'View/headerMenu.php' ?>
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
</body>
</html>

