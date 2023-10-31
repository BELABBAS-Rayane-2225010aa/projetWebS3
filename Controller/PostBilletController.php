<?php
/**
 * Controller de la page PostBillet.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page PostBillet
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @euthor HOURLAY-Enzo-2225045a <enzo.hourlay@etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\BilletRepository
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;

use App\Exception\CannotCreateBilletException;
use App\Exception\NotFoundException;
use App\Model\Billet;
use App\Repository\BilletRepository;
use App\Model\User;
use App\Repository\UserRepository;

/**
 * Cette class permet de réaliser l'actions : getNewBillet
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author HOURLAY-Enzo-2225045a <enzo.hourlay@etu.univ-amu.fr>
 */
class PostBilletController
{

    /**
     * permet de créer un billet
     *
     * @catch CannotCreateBilletException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     * @author HOURLAY-Enzo-2225045a <enzo.hourlay@etu.univ-amu.fr>
     *
     * @return void
     */
    public function getNewBillet() : void {
        //on recupere les donnees du formulaire et on en creer de nouvel
        $title = $_POST['title'];
        $msg = $_POST['msg'];
        $authorID = $_POST['authorID'];
        $categoryId = $_POST['category'];
        date_default_timezone_set("Europe/Paris");
        $dateBillet = date("Y-m-d H:i:s");

        try{
            $billet = new BilletRepository();
            $msg = $billet->createBillet($title,$msg,$dateBillet,$authorID,$categoryId);
        }

        //on catch si on ne peut pas creer le Billet
        catch (CannotCreateBilletException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message à l'admin en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}