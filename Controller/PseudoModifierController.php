<?php
/**
 * Controller de la page PseudoModifier.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page PseudoModifier
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\UserRepository
 *
 * @version 1.0
 */

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Exception\PseudoVerificationException;
use App\Repository\UserRepository;

/**
 * Cette class permet de réaliser l'action : modifEmail
 */
class PseudoModifierController
{
    /**
     * permet de modifier le pseudo d'un User
     *
     * @catch PseudoVerificationException
     * @catch CannotModify
     *
     * @return void
     */
    public function modifPseudo() : void
    {
        //on récupère les données du formulaire en hashant les password
        $oldPseudo = $_POST['oldPseudo'];
        $newPseudo = $_POST['newPseudo'];
        $password = md5($_POST['password']);

        try {
            $user = new UserRepository();
            $login = $user->pseudoModifier($oldPseudo,$newPseudo,$password);
            $session = new SetSession();
            $session->setUserSession($login);
            $msg = "Pseudo successfully modified";
        }

        //on catch si la vérification des password n'est pas bonne ou si on ne peut pas modifier
        catch (PseudoVerificationException|NotFoundException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on envoie un message en cas de reussite ou d'erreur
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
    }
}