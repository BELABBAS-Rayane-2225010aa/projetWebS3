<?php
/**
 * Model représentant les User
 *
 * @author Crespin Alexandre
 *
 * @see \App\Repository\UserRepository
 * @see \App\Controller\LoginController
 * @see \App\Controller\SignUpController
 * @see \App\Controller\PostBilletController
 *
 * @version 1.0
 */

namespace App\Model;

/**
 * La classe User permet de gérer les utilisateurs
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class User
{
    /**
     * Le constructeur de la class User
     *
     * @param int $userId => l'id du user
     * @param string $password => mot de passe du User
     * @param string $pseudo => nom d'affichage du User
     * @param string $email => addresse mail du User
     * @param string $dateFirstCo => date d'inscription du User
     * @param string $dateLastCo => date de dernière connexion du User
     * @param int $isAdmin => 1 si il s'agit d'un admin et 0 sinon (on utilise des chiffre à cause de la BD)
     */
    public function __construct(private int $userId,private string $password, private string $pseudo,
                                private string $email,private string $dateFirstCo,
                                private string $dateLastCo, private int $isAdmin){

    }

    /**
     * getter de l'attribut userId
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
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

    /**
     * getter de l'attribut isAdmin
     *
     * @return int
     */
    public function getIsAdmin(): int
    {
        return $this->isAdmin;
    }
}