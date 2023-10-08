<?php

namespace Controller;

class LoginController
{
    public function getlogin() : \Model\User {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['mdp'];
        try {
            return (new \UserRepository)->login($pseudo , $password);
        }
        catch (\Exception\NotFoundException $ERROR){
            echo 'Erreur de requête<br>',$ERROR->getMessage(),PHP_EOL;
                // Affiche le type d'erreur.
            echo 'Erreur : ' . \UserRepository::$statement->errorCode() . json_encode(\UserRepository::$statement->errorInfo()) . '<br>';
                // Affiche la requête envoyée.
            echo 'Requête : ' . \UserRepository::$query, PHP_EOL;
            exit();
        }
    }
}