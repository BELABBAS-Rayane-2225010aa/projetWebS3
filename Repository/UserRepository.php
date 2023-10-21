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
 * @todo : vérifier que tous marche comme il faut
 * @todo : modifier en corélation Model\User.php pour optimiser le code
 */

namespace App\Repository;

require 'vendor/autoload.php';

use App\Exception\{CannotCreateUserException,
    CannotDeleteUserException,
    CannotModify,
    EmailVerificationException,
    NotFoundException,
    PasswordVerificationException,
    PseudoVerificationException};

use App\Model\User;
use phpDocumentor\Reflection\Types\Void_;

class UserRepository extends AbstractRepository
{
    /**
     * Le constructeur de la class BilletRepository
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
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and MDP = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $password]);

       if ( $statement -> rowCount() === 0 ){
           throw new NotFoundException("USER not Found");
       }

       $user = $statement->fetch();

       return new User($user['MDP'],$user["PSEUDO"],$user['MAIL'],$user['DATE_PREM'],$user['DATE_DER'],$user['ISADMIN']);
       //return User::loginUser($user['MDP'], $user['PSEUDO']);
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
     * @param string $email1 => la confirmation du mail
     * @param string $dateFirstCo => la date de première connexion
     * @param string $dateLastCo => la date de dernière connexion qui sera = à la date de première connexion
     *
     * @throws EmailVerificationException
     * @throws PasswordVerificationException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function signUp(string $password, string $password1,string $pseudo, string $email,
                           string $email1, string $dateFirstCo, string $dateLastCo): User {
        /* On vérifie si les confirmations de email et de password sont bon*/
        if ($email != $email1){
            throw new EmailVerificationException("Not the same email");
        }

        if ($password != $password1){
            throw new PasswordVerificationException("Not the same password");
        }

        $query = 'INSERT INTO USER (MDP, PSEUDO, MAIL, DATE_PREM, DATE_DER,ISADMIN) VALUES (:password, :pseudo, :email, :dateFirstCo, :dateLastCo,0)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['password' => $password, 'pseudo'=> $pseudo,
            'email' => $email, 'dateFirstCo' => $dateFirstCo, 'dateLastCo' => $dateLastCo]);

        if ( $statement -> rowCount() === 0){
            throw new CannotCreateUserException("USER cannot be created");
        }

        /* Aprés avoir créer l'utilisateur on le connecte*/
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
     * @return void => Fait directement la modification
     */
    public function passwordModifier(string $oldPassword, string $newPassword, string $newPassword1): void
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
        //TODO : vérifier si l'utilisateur n'essaie pas d'avoir le même pseudo qu'un tiers
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
     * @return void
     */
    public function deleteUs(int $userId) : void {
        //TODO : empécher la suppression d'admin
        $query = 'DELETE FROM USER WHERE USER_ID = :userId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['userId' => $userId]);

        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteUserException("USER cannot be deleted");
        }
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
     * @return void
     */
    public function makeAdmin(int $id) : void {
        //TODO : empécher la modification d'admin
        $query = 'UPDATE USER SET ISADMIN = 1 WHERE USER_ID = :id';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['id' => $id]);

        if ( $statement -> rowCount() === 0){
            throw new CannotModify("USER ISADMIN cannot be modified");
        }
    }
}