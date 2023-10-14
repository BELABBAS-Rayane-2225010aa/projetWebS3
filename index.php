<?php
namespace App;

require 'vendor/autoload.php';

use App\Controller\IndexController;
use App\Controller\LoginController;
use App\Controller\SignUpController;

require 'View/GestionPage.php';

if (isset($_POST['SignIn'])) {
    if ($_POST['SignIn'] === 'SignIn') {
        $controller = new LoginController();
        $controller->getLogin();

    } else {
        //TODO : Erreur
    }
}

if (isset($_POST['SignUp'])) {
    if ($_POST['SignUp'] === 'SignUp') {
        $controller = new SignUpController();
        $controller->getSignUp();
    } else {
        //TODO : Erreur
    }
}

$BilletController = new IndexController();
$cinqBillet = $BilletController->get5Billet();

start_page('Acceuil');
?>
<body>
<?php
$active = 'index';
var_dump($_SESSION);
require 'View/headerMenu.php';
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


