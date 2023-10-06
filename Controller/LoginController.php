<?php

namespace Controller;

class LoginController
{


    public function __construct()
    {
    }

    public function getLogin()  {
        $pseudo = $_GET['pseudo'];
        $password = $_GET['mdp'];
        try {
             $user = \UserRepository::login($pseudo , $password);
             if ($pseudo === $user->getPseudo() && $pseudo === $user->getPassword() ){
                $_SESSION['suid'] = session_id();
                header('Location: /View/Page/Bonjour.php');
                exit() ;
             }
        }
        catch (\NotFoundException $ERROR){
            echo 'Erreur de requête<br>',$ERROR->getMessage(),PHP_EOL;
                // Affiche le type d'erreur.
            echo 'Erreur : ' . \UserRepository::$statement->errorCode() . json_encode(\UserRepository::$statement->errorInfo()) . '<br>';
                // Affiche la requête envoyée.
            echo 'Requête : ' . \UserRepository::$query, PHP_EOL;
            exit();
        }
    }
}