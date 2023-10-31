<?php
/**
 * Outil d'unset et reset de $_SESSION
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @version 1.0
 *
 * @todo : vérifier si on ne peut pas faire passer toutes les modifications de $_SESSION interne au controller et repo ici
 */

namespace App\Controller;

/**
 * Cette class permet de réaliser l'action : setUserSession
 */
class SetSession
{
    /**
     * permet de modifier le $_SESSION['user'] et donc le User actif
     *
     * @param $user : un User que l'on veut set comme session active
     * @return void
     */
    public function setUserSession($user) : void {
        //on unset le session_id et le User de session
        unset($_SESSION['suid']);
        unset($_SESSION['user']);

        //on reset le session_id et le User de session
        $_SESSION['suid'] = session_id();
        $_SESSION['user'] = $user;
    }
}