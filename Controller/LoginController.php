<?php
/**
 * Controller de la page Login.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page Login
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

use App\Exception\EmptyFieldException;
use App\Repository\UserConnectedRepository;
use App\Repository\UserRepository;
use App\Exception\NotFoundException;

/**
 * La classe LoginController permet de traiter la requête SQL de la fonction login
 */
class LoginController
{

    /**
     * récupère le USER renvoyer par la fonction login
     * et permet à l'utilisateur de se connecter
     *
     * @catch NotFoundException
     *
     * @return void génère un identifiant de session unique pour l'utilisateur actuel
     * et stocke cet objet dans une variable de session appelée 'user'.
     * stocke dans une variable de session un msg d'erreur ou de reussite
     */
    public function getLogin(): void
    {
        //on recupère le pseudo et le password rentrer dans la formulaire par le User
        $pseudo = $_POST['pseudo'];
        $password = md5($_POST['password']);    //on encode la password

        try {
            //on récupère le User qui correspond dans la BD
            $user = new UserRepository();
            $login = $user->login($pseudo , $password);

            //on update ISCONNECTED et DATE_DER dans la BD
            $connected = new UserConnectedRepository();
            file_put_contents('Log/tavernDeBill.log', $connected->logIn($login),FILE_APPEND | LOCK_EX);

            //on set la session
            $session = new SetSession();
            $session->setUserSession($login);
        }
        //on catch si l'utilisateur n'est pas trouvé
        catch (NotFoundException | EmptyFieldException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            if (isset($_SESSION['msg'])){
                unset($_SESSION['msg']);
            }
            $_SESSION['msg'] = $ERROR->getMessage();
        }
    }
}