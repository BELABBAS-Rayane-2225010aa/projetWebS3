<?php
/**
 * Model représentant les utilisateurs Admins
 *
 * Une class fils de la class User qui nous permet de donnée des  droits
 * supplémentaires aux Admins
 *
 * @author Crespin Alexandre
 *
 * @deprecated class jamais utilisé
 *
 * @see \App\Model\User
 *
 * @version 1.0
 */

namespace App\Model;

use App\Model\User;

/**
 * La classe Admin permet de gérer les administrateur du forum
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 */
class Admin extends User
{
    /**
     * Le constructeur de la class Admin
     *
     * Il prend les même données que les User normaux mais ont juste $isAdmin mis à true
     * Il appel ensuite le constructeur de la class parent cad User
     *
     * @param string $password => mot de passe du User
     * @param string $pseudo => nom d'affichage du User
     * @param string $email => addresse mail du User
     * @param string $dateFirstCo => date d'inscription du User
     * @param string $dateLastCo => date de dernière connexion du User
     * @param bool $isAdmin => si il est un admin ou non, et à true dans notre cas
     *
     * @return void
     */
    public function __construct(private string $password, private string $pseudo,
                                private string $email,private string $dateFirstCo,
                                private string $dateLastCo,private bool $isAdmin){
        parent::__construct($this->password,$this->pseudo,$this->email,$this->dateFirstCo,$this->dateLastCo);
    }

    /**
     * getter de l'attribut de class isAdmin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}