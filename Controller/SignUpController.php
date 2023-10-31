<?php
/**
 * Controller de la page SignUp.php
 *
 * Cette class permet de faire toutes les actions utilisateurs de la page Signup
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 * @author HOURLAY-Enzo-2225045a <enzo.hourlay@etu.univ-amu.fr>
 *
 * @package App\Controller
 *
 * @version 0.9
 *
 * @todo : verifier l'utilité des exceptions
 */

namespace App\Controller;

use App\Repository\UserConnectedRepository;
use App\Repository\UserRepository;
use App\Exception\{CannotCreateUserException, EmptyFieldException, PasswordVerificationException};

class SignUpController
{

    /**
     * permet de créer un nouveau User et le connecter
     *
     * @catch CannotCreateUserException
     * @catch PasswordVerificationException
     * @catch NotFoundException
     *
     * @return void
     */
    public function getSignUp() : void {
        //on recupère les information rentrer dans la formulaire par le User
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);
        $date = date("Y-m-d H:i:s");

        try{
            //on créer et récupère le User qui correspond dans la BD
            $user = new UserRepository();
            $signup = $user->signUp($password,$password1,$pseudo,$email,$date,$date);

            //on update ISCONNECTED dans la BD
            $connected = new UserConnectedRepository();
            file_put_contents('Log/tavernDeBill.log', $connected->logIn($signup),FILE_APPEND | LOCK_EX);

            //on set la session
            $session = new SetSession();
            $session->setUserSession($signup);
        }

        //on catch si un champ de saisie est vide ou si on ne peut pas créer l'utilisateurs ou si les password données ne sont pas les même
        catch (EmptyFieldException | CannotCreateUserException | PasswordVerificationException $ERROR){
            //on fais un retour d'erreur
            file_put_contents('Log/tavernDeBill.log',$ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            if (isset($_SESSION['msg'])){
                unset($_SESSION['msg']);
            }
            $_SESSION['msg'] = $ERROR->getMessage();
        }
    }
}