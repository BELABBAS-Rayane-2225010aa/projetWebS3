<?php

namespace App\Controller;

use App\Repository\UserConnectedRepository;
use App\Repository\UserRepository;
use App\Exception\NotFoundException;

/**
 * La classe LoginController permet de traiter la requête SQL de la fonction login
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
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

            //on update ISCONNECTED dans la BD
            $connected = new UserConnectedRepository();
            file_put_contents('Log/tavernDeBill.log', $connected->logIn($login),FILE_APPEND | LOCK_EX);

            //on set la session
            $session = new SetSession();
            $session->setUserSession($login);
        }
        //on catch si l'utilisateur n'est pas trouvé
        catch (NotFoundException $ERROR){
            $msg = $ERROR->getMessage();
        }

        //on fais un retour d'erreur ou de réussite
        file_put_contents('Log/tavernDeBill.log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}