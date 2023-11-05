<?php
/**
 * Repository de la class User
 *
 * Cette class permet de faire toutes les requête SQL en relation avec notre BD
 *
 * @author Belebbas Rayane / Crespin Alexandre
 *
 * @see \App\Model\User
 *
 * @package App\Repository
 *
 * @template-extends AbstractRepository
 *
 * @version 0.9
 *
 * todo : faire en sorte que deux User ne puisse pas avoir la même pseudo
 */

namespace App\Repository;

use App\Exception\{CannotCreateUserException,
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
 * Cette class permet de réaliser les actions : login / signUn / passwordModifier / pseudoModifier / emailModifier /
 *  deleteUs / makeAdmin / isAdmin / searchUser / getPseudoFromID
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
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
        //On vérifie si une des information est vide
        if ($pseudo === "" || $password === "" ){
            throw new EmptyFieldException("Un champ de saisie est vide");
        }

        //on select tout les Users avec le même pseudo et password
       $query = 'SELECT * FROM USER WHERE PSEUDO = :pseudo and MDP = :password';
       $statement = $this->connexion -> prepare(
            $query );
       $statement->execute(['pseudo' => $pseudo , 'password' => $password]);

       //Si la fonction ne rend rien cela veut dire qu'il n'y a pas de User correspondant
       if ( $statement -> rowCount() === 0 ){
           throw new NotFoundException("L'utilisateur de pseudo : ".$pseudo." n'a pas été trouvé");
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
            throw new CannotCreateUserException("Le USER de pseudo : ".$pseudo." ne peut pas être créer");
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
     * @throws NotFoundException
     *
     * @return string => renvoie un message si l'action s'est bien passer
     */
    public function passwordModifier(string $oldPassword, string $newPassword, string $newPassword1): string
    {
        //On vérifie si l'ancien et le nouveau mot de pâsse sont les mêmes
        if ($oldPassword == $newPassword) {
            throw new PasswordVerificationException("Même mot de passe que l'ancien");
        }

        //On vérifie si les confirmations de password sont bon
        if ($newPassword != $newPassword1) {
            throw  new PasswordVerificationException("La confirmation du mot de passe et le nouveau mot de passe ne sont pas les mêmes");
        }

        //On fait la modification dans la BD
        $query = 'UPDATE USER SET MDP = :newPassword WHERE MDP = :oldPassword';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['newPassword' => $newPassword, 'oldPassword' => $oldPassword]);

        //Si la requête ne rend rien ça veut dire que le User n'est pas trouvé
        if ($statement->rowCount() === 0) {
            throw new NotFoundException("Erreur dans votre ancien mot de passe");
        }

        return "Le password a bien été modifier";
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
     * @throws NotFoundException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function pseudoModifier(string $oldPseudo, string $newPseudo, string $password): User
    {
        //On vérifie si l'ancien et le nouveau Pseudo sont les mêmes
        if ($oldPseudo == $newPseudo){
            throw new PseudoVerificationException("Même pseudo que l'ancien");
        }

        //On fait la modification dans la BD
        $query = 'UPDATE USER SET PSEUDO = :newPseudo WHERE PSEUDO = :oldPseudo AND MDP = :password';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['newPseudo' => $newPseudo, 'oldPseudo' => $oldPseudo, 'password' => $password]);

        //Si la requête ne rend rien ça veut dire que le User n'est pas trouvé
        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Le pseudo du User : ".$oldPseudo." ne peut être modifier");
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
     * @throws NotFoundException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function emailModifier(string $oldEmail, string $newEmail, string $pseudo, string $password): User
    {
        //On vérifie si l'ancienne et la nouvelle adresse mail sont les mêmes
        if ($oldEmail == $newEmail){
            throw new EmailVerificationException("Même email que l'ancien");
        }

        //On fait la modification dans la BD
        $query = 'UPDATE USER SET MAIL = :newEmail WHERE MAIL = :oldEmail AND PSEUDO = :pseudo AND MDP = :password';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['newEmail' => $newEmail, 'oldEmail' => $oldEmail, 'pseudo' => $pseudo, 'password' => $password]);

        //Si la requête ne rend rien ça veut dire que le User n'est pas trouvé
        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Le mail du User : ".$pseudo." ne peut être modifier");
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
     * @throws NotFoundException
     *
     * @return string
     */
    public function deleteUs(int $userId) : string
    {
        //On vérifie si l'utilisateur qu'on veut supprimer est un admin
        if ($this->isAdmin($userId) === false) {

            //On supprime l'Utilisateur de la BD
            $query = 'DELETE FROM USER WHERE USER_ID = :userId';
            $statement = $this->connexion->prepare(
                $query);
            $statement->execute(['userId' => $userId]);

            //Si la requête ne rend rien ça veut dire que  l'utilisateur n'existe pas
            if ($statement->rowCount() === 0) {
                throw new NotFoundException("Le USER d'id : " . $userId . " ne peut pas être supprimer");
            }
        } else {
            throw new UserIsAdminException("Le USER d'id : " . $userId . " est un Admin");
        }
        return "Le USER d'id : ".$userId." a bien été supprimé";
    }

    /**
     * Fonction d'OP un utilisateur
     *
     * Cette fonction permet de rendre vrai l'attribut boolean ISADMIN de la table USER de la base de donnée
     *
     * @param int $id => le numéro d'identification d'un utilisateur
     *
     * @throws NotFoundException
     * @throws UserIsAdminException
     *
     * @return string
     */
    public function makeAdmin(int $id) : string {

        //On vérifie si l'utilisateur est un admin ou pas
        if ($this->isAdmin($id) === false){

            //On le transforme en admin
            $query = 'UPDATE USER SET ISADMIN = 1 WHERE USER_ID = :id';
            $statement = $this->connexion -> prepare(
                $query );
            $statement->execute(['id' => $id]);

            //Si la requête ne rend rien ça veut dire que  l'utilisateur n'existe pas
            if ( $statement -> rowCount() === 0){
                throw new NotFoundException("Le USER d'id : ".$id." ne peut pas être modifier");
            }
        }
        else {
            throw new UserIsAdminException("Le USER d'id : ".$id." est un Admin");
        }

        return "Le USER d'id : ".$id." a bien été mdoifier";
    }

    /**
     * Fonction isAdmin
     *
     * Cette fonction utilise l'id d'un utilisateur pour voir s'il est un admin
     *
     * @param int $id => id  de l'utilisateur
     *
     * @return bool => si oui ou non il est admin
     */
    public function isAdmin(int $id) : bool {

        //On select le User qui est admin
        $query = 'SELECT * FROM USER WHERE USER_ID = :id AND ISADMIN = 1';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['id' => $id]);

        //Si la requête ne renvoie rien ça veut dire que le User n'est pas admin
        if ($statement->rowCount() === 0){
            return false;
        }
        return true;
    }

    /**
     * Fonction searchUser
     *
     * Cette fonction récupère un texte et interroge la base de donnèes pour voir s'il existe un pseudo qui comporte
     *  ce qui a été noté
     *
     * @param string $recherche => texte que l'utilisateur rentre
     *
     * @throws NotFoundException
     *
     * @return array => la liste des utilisateurs trouvé
     */
    public function searchUser(string $recherche) : array
    {
        //On select les utilisateur dont le pseudo possède $q dans leur pseudo
        $query = 'SELECT * FROM USER WHERE PSEUDO LIKE "%' . $recherche . '%" ORDER BY USER_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();

        //Si la requête ne rend rien ça veut dire qu'il n'existe aucun utilisateur qui a $q dans son pseudo
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun User trouvé pour : '.$recherche.' ...');
        }

        //on créer un tableau de Usercontenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayUser = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau d'User'*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $user = new User($arraySQL[$i]['USER_ID'], $arraySQL[$i]['MDP'], $arraySQL[$i]['PSEUDO'],
                $arraySQL[$i]['MAIL'], $arraySQL[$i]['DATE_PREM'], $arraySQL[$i]['DATE_DER'], $arraySQL[$i]['ISADMIN']);
            $arrayUser[] = $user;
        }

        return $arrayUser;
    }

    /**
     * Fonction getPseudoFromID
     *
     * Cette fonction utilise l'id d'un utilisateur pour le retrouver
     *
     * @param int $id => id  de l'utilisateur
     *
     * @throws NotFoundException
     *
     * @return User => une instance de la class User créer pour l'occasion
     */
    public function getPseudoFromID (int $id) :User {
        //On select un utilisateur par rapport a son id
        $query = 'SELECT DISTINCT * FROM USER WHERE USER.USER_ID = :id';
        $statement = $this->connexion->prepare(
            $query);
        $statement ->execute(['id'=>$id]);

        //Si la requête ne rend rien ça veut dire qu'il n'y a aucun utilisateurs avec cette id
        if ($statement->rowCount()===0){
            throw new NotFoundException('Aucun USER trouvé');
        }
        $user = $statement->fetch();

        return new User($user['USER_ID'],$user['MDP'],$user["PSEUDO"],$user['MAIL'],$user['DATE_PREM'],$user['DATE_DER'],$user['ISADMIN']);
    }
}