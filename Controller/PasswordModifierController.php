<?php
/**
 * Controller de la page HeaderMenu.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page HeaderMenu
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @see \App\Repository\UserRepository
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;


use App\Exception\CannotModify;
use App\Exception\PasswordVerificationException;
use App\Repository\UserRepository;

/**
 * Cette class permet de réaliser les actions : modifPassword
 */
class PasswordModifierController
{
    /**
     * permet de modifier le password d'un User
     *
     * @catch NotFoundException
     *
     * @return void
     */
    public function modifPassword() : void
    {
        //on recupere les donnees du formulaire en hashant les password
        $oldPassword = md5($_POST['oldPassword']);
        $newPassword = md5($_POST['newPassword']);
        $newPassword1 = md5($_POST['newPassword1']);

        try {
            $user = new UserRepository();
            $msg = $user->passwordModifier($oldPassword,$newPassword,$newPassword1);
        }

        //on catch si la vérification des password n'est pas bonne ou si on ne peut pas modifier
        catch (PasswordVerificationException | CannotModify $ERROR){
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