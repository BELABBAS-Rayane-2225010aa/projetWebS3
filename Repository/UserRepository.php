<?php
/**
 * Repository de la class User
 *
 * Cette class permet de faire toutes les requête SQL en relation avec notre BD
 *
 * @author Belebbas Rayane / Crespin Alexandre / Hourlay Enzo
 *
 * @see \App\Controller\LoginController
 * @see \App\Controller\SignUpController
 *
 * @version 0.9
 *
 * todo : faire en sorte que deux User ne puisse pas avoir la même pseudo
 */

namespace App\Repository;

use App\Exception\{CannotCreateUserException,
    CannotDeleteUserException,
    CannotModify,
    EmailVerificationException,
    EmptyFieldException,
    NotFoundException,
    PasswordVerificationException,
    PseudoVerificationException,
    UserIsAdminException};

use App\Model\User;
use phpDocumentor\Reflection\Types\Void_;

/**
 * La classe UserRepository permet de gérer les requête SQL relatifs aux utilisateurs
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 */
class UserRepository extends AbstractRepository
{
    /**
     * Le constructeur de la classe UserRepository
     *
     * on appelle le constructeur de la class parent AbstractRepository
     * pour récupérer la connexion à la BD
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction de login
     *
     * Cette fonction permet de récupérer un User déjà présent dans la base de donnée
     *
     * @param string $pseudo => pseudo du User
     * @param string $password => password du User
     *
     * @throws NotFoundException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function login(string $pseudo , string $password) : User
    {
        //on select toute le User avec le même pseudo et password
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and MDP = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $password]);

       //Si la fonction ne rend rien cela veut dire qu'il n'y a pas de User correspondant
       if ( $statement -> rowCount() === 0 ){
           throw new NotFoundException("USER not Found");
       }

       $user = $statement->fetch();

       return new User($user['USER_ID'],$user['MDP'],$user["PSEUDO"],$user['MAIL'],$user['DATE_PREM'],$user['DATE_DER'],$user['ISADMIN']);

    }

    /**
     * Sign up des utilisateurs
     *
     * Cette fonction permet d'ajouté dans la BD un utilisateurs
     * qui aurai rentré ses information dans le formulaire prévue
     *
     * @param string $password => password du User
     * @param string $password1 => confirmation du password
     * @param string $pseudo => pseudo du User
     * @param string $email => le mail du User
     * @param string $dateFirstCo => la date de première connexion
     * @param string $dateLastCo => la date de dernière connexion qui sera = à la date de première connexion
     *
     * @throws EmptyFieldException
     * @throws PasswordVerificationException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function signUp(string $password, string $password1,string $pseudo, string $email,
                           string $dateFirstCo, string $dateLastCo): User {
        //On vérifie si une des information est vide
        //TODO : trouvé une manière plus simple pour ce if
        if ($password === "" || $password1 === "" || $pseudo === "" || $email === "" || $dateFirstCo === "" || $dateLastCo === ""){
            throw new EmptyFieldException("Un champ de saisie est vide");
        }

        //On vérifie si les confirmations de password sont bon
        if ($password != $password1){
            throw new PasswordVerificationException("Mot de passe différent");
        }

        //on insert dans la BD le nouvel utilisateur
        $query = 'INSERT INTO USER (MDP, PSEUDO, MAIL, DATE_PREM, DATE_DER,ISADMIN,ISCONNECTED) VALUES (:password, :pseudo, :email, :dateFirstCo, :dateLastCo,0,0)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['password' => $password, 'pseudo'=> $pseudo,
            'email' => $email, 'dateFirstCo' => $dateFirstCo, 'dateLastCo' => $dateLastCo]);

        //Si la requête ne nous rend rien on dit que l'on peut pas insérer
        if ( $statement -> rowCount() === 0){
            throw new CannotCreateUserException("USER cannot be created");
        }

        //Aprés avoir créer l'utilisateur on le connecte
        return $this->login($pseudo,$password);
    }

    /**
     * Fonction de modification du mot de passe de l'utilisateur
     *
     * Cette fonction permet de modifier l'attribut MDP dans la table USER de la base de donnée
     *
     * @param string $oldPassword => ancien password de l'utilisateur
     * @param string $newPassword => le nouveau password de l'utilisateur
     * @param string $newPassword1 => la vérification du nouveau password de l'utilisateur
     *
     * @throws PasswordVerificationException
     *
     * @return string => renvoie un message si l'action s'est bien passer
     */
    public function passwordModifier(string $oldPassword, string $newPassword, string $newPassword1): string
    {
        if ($oldPassword == $newPassword) {
            throw new PasswordVerificationException("Same password as the old one");
        }
        if ($newPassword != $newPassword1) {
            throw  new PasswordVerificationException("The confirmation is not the same of the new password");
        }

        $query = 'UPDATE USER SET MDP = :newPassword WHERE MDP = :oldPassword';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['newPassword' => $newPassword, 'oldPassword' => $oldPassword]);

        if ($statement->rowCount() === 0) {
            throw new CannotModify("USER MDP cannot be modify");
        }

        return "Password succesfully modified";
    }

    /**
     * Fonction de modification du Pseudo de l'utilisateur
     *
     * Cette fonction permet de modifier l'attribut PSEUDO dans la table USER de la base de donnée
     *
     * @param string $oldPseudo => ancien pseudo de l'utilisateur
     * @param string $newPseudo => le nouveau pseudo de l'utilisateur
     * @param string $password => password de l'utilisateur
     *
     * @throws PseudoVerificationException
     * @throws CannotModify
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function pseudoModifier(string $oldPseudo, string $newPseudo, string $password): User
    {
        if ($oldPseudo == $newPseudo){
            throw new PseudoVerificationException("Same pseudo as the old one");
        }

        $query = 'UPDATE USER SET PSEUDO = :newPseudo WHERE PSEUDO = :oldPseudo AND MDP = :password';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['newPseudo' => $newPseudo, 'oldPseudo' => $oldPseudo, 'password' => $password]);

        if ( $statement -> rowCount() === 0){
            throw new CannotModify("USER PSEUDO cannot be modify");
        }

        return $this->login($newPseudo,$password);
    }

    /**
     * Fonction de modification de l'adresse mail de l'utilisateur
     *
     * Cette fonction permet de modifier l'attribut MAIL dans la table USER de la base de donnée
     *
     * @param string $oldEmail => ancien adresse mail de l'utilisateur
     * @param string $newEmail => le nouvelle adresse mail de l'utilisateur
     * @param string $pseudo => le pseudo de l'utilisateur
     * @param string $password => le password de l'utilisateur
     *
     * @throws EmailVerificationException
     * @throws CannotModify
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function emailModifier(string $oldEmail, string $newEmail, string $pseudo, string $password): User
    {
        if ($oldEmail == $newEmail){
            throw new EmailVerificationException("Same mail as the old one");
        }

        $query = 'UPDATE USER SET MAIL = :newEmail WHERE MAIL = :oldEmail AND PSEUDO = :pseudo';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['newEmail' => $newEmail, 'oldEmail' => $oldEmail, 'pseudo' => $pseudo]);

        if ( $statement -> rowCount() === 0){
            throw new CannotModify("USER MAIL cannot be modify");
        }

        return $this->login($pseudo,$password);
    }

    /**
     * Fonction de suppression d'un utilisateur
     *
     * Cette fonction permet de supprimer un User de la table USER de la base de donnée
     *
     * @param int $userId => le numéro d'identification d'un utilisateur
     *
     * @throws CannotDeleteUserException
     *
     * @return string
     */
    public function deleteUs(int $userId) : string
    {
        if ($this->isAdmin($userId) === false) {
            $query = 'DELETE FROM USER WHERE USER_ID = :userId';
            $statement = $this->connexion->prepare(
                $query);
            $statement->execute(['userId' => $userId]);

            if ($statement->rowCount() === 0) {
                throw new CannotDeleteUserException("USER number " . $userId . " cannot be deleted");
            }
        } else {
            throw new UserIsAdminException("USER number " . $userId . " is an Admin");
        }
        return "USER number ".$userId." as been deleted";
    }

    /**
     * Fonction d'OP un utilisateur
     *
     * Cette fonction permet de rendre vrai l'attribut boolean ISADMIN de la table USER de la base de donnée
     *
     * @param int $id => le numéro d'identification d'un utilisateur
     *
     * @throws CannotModify
     *
     * @return string
     */
    public function makeAdmin(int $id) : string {
        if ($this->isAdmin($id) === false){
            $query = 'UPDATE USER SET ISADMIN = 1 WHERE USER_ID = :id';
            $statement = $this->connexion -> prepare(
                $query );
            $statement->execute(['id' => $id]);

            if ( $statement -> rowCount() === 0){
                throw new CannotModify("USER number ".$id." cannot be modified");
            }
        }
        else {
            throw new UserIsAdminException("USER number ".$id." is an Admin");
        }

        return "USER number ".$id." successfully modified";
    }

    public function isAdmin(int $id) : bool {
        $query = 'SELECT * FROM USER WHERE USER_ID = :id AND ISADMIN = 1';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['id' => $id]);
        if ($statement->rowCount() === 0){
            return false;
        }
        return true;
    }

    public function searchUser(string $q) : array
    {
        $query = 'SELECT * FROM USER WHERE PSEUDO LIKE "%' . $q . '%" ORDER BY USER_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun User trouvé pour '.$q.' .');
        }
        $arraySQL = $statement->fetchAll();
        $arrayUser = array();

        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $user = new User($arraySQL[$i]['USER_ID'], $arraySQL[$i]['MDP'], $arraySQL[$i]['PSEUDO'],
                $arraySQL[$i]['MAIL'], $arraySQL[$i]['DATE_PREM'], $arraySQL[$i]['DATE_DER'], $arraySQL[$i]['ISADMIN']);
            $arrayUser[] = $user;
        }

        return $arrayUser;
    }
    public function pseudoFromAuteurID ($id) :User {
        $query = 'SELECT DISTINCT * FROM USER WHERE USER.USER_ID = :id';
        $statement = $this->connexion->prepare(
            $query);
        $statement ->execute(['id'=>$id]);
        if ($statement->rowCount()===0){
            throw new NotFoundException('Pas d\'autheur');
        }
        $user = $statement->fetch();

        return new User($user['USER_ID'],$user['MDP'],$user["PSEUDO"],$user['MAIL'],$user['DATE_PREM'],$user['DATE_DER'],$user['ISADMIN']);
    }
}