<?php
/**
 * Controller de la page BilletModifier.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page BilletModifier
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
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

use App\Exception\CannotFindBilletException;
use App\Repository\BilletRepository;

/**
 * Cette class permet de réaliser l'actions : updateBillet
 */
class BilletModifierController
{
    /**
     * permet de modifier un billet
     *
     * @catch CannotFindBilletException
     *
     * @return void
     */
    public function updateBillet(): void {
        //on recupere les donnees du formulaire et on en creer de nouvel
        $oldTitle = $_POST['oldTitle'];
        $title = $_POST['title'];
        $msg = $_POST['desc'];
        $dateBillet = date("Y-m-d H:i:s");
        $authorId = $_POST['authorID'];
        $categoryId = $_POST['category'];

        try{
            $billet = new BilletRepository();
            $msg = $billet->updateBillet($oldTitle,$title,$msg,$dateBillet,$authorId,$categoryId);
        }

        //on catch si on ne peut pas trouvé le Billet à modifier
        catch(CannotFindBilletException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message en cas de reussite ou d'erreur
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}