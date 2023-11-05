<?php
/**
 * Controller de la page EmailModifier.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page EmailModifier
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\UserRepository
 *
 * @version 1.0
 */

namespace App\Controller;

use App\Exception\EmailVerificationException;
use App\Exception\NotFoundException;
use App\Repository\UserRepository;

/**
 * Cette class permet de réaliser l'action : modifEmail
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class EmailModifierController
{
    /**
     * permet de modifier l'email d'un User
     *
     * @catch EmailVerificationException
     * @catch NotFoundException
     *
     * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
     *
     * @return void
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function modifEmail() : void
    {
        //on recupere les donnees du formulaire
        $oldEmail = $_POST['oldEmail'];
        $newEmail = $_POST['newEmail'];
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];

        try {
            $user = new UserRepository();
            $login = $user->emailModifier($oldEmail,$newEmail,$pseudo,$password);
            $session = new SetSession();
            $session->setUserSession($login);
            $msg = "Email successfully modified";
        }

        //on catch si la vérification des mails ne sont pas bon ou si on ne peut pas modifier
        catch (EmailVerificationException|NotFoundException $ERROR){
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