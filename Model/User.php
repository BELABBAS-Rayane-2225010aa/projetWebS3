<?php
/**
 * Model représentant les User
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\UserRepository
 * @see \App\Controller\LoginController
 * @see \App\Controller\SignUpController
 *
 * @version 0.9
 *
 * @todo : verifier si les setter sont bon niveau sécurité
 */

namespace App\Model;

class User
{
    /**
     * Le constructeur de la class User
     *
     * @param string $password => mot de passe du User
     * @param string $pseudo => nom d'affichage du User
     * @param string $email => addresse mail du User
     * @param string $dateFirstCo => date d'inscription du User
     * @param string $dateLastCo => date de dernière connexion du User
     *
     * @return void
     */
    public function __construct(private string $password, private string $pseudo,
                                private string $email,private string $dateFirstCo,
                                private string $dateLastCo){

    }

    /**
     * Overload du constructeur
     *
     * @deprecated cette fonction n'est plus utilissé dans notre code
     *
     * @param string $password
     * @param string $login
     * @return self
     *
     * @return void
     *
     * @todo : vérifier l'utilisation de cette fonction et l'enlever au besoin
     */
    public static function loginUser (string $password , string $login):self {
        return new self($password,'',$login,'','','');
    }

    /**
     * getter de l'attribut password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * getter de l'attribut pseudo
     *
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * getter de l'attribut email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * getter de l'attribut dateFirstCo
     *
     * @return string
     */
    public function getDateFirstCo(): string
    {
        return $this->dateFirstCo;
    }

    /**
     * getter de l'attribut dateLastCo
     *
     * @return string
     */
    public function getDateLastCo(): string
    {
        return $this->dateLastCo;
    }
}