<?php
/**
 * Repository de la class Billet
 *
 * Cette class permet de faire toutes les requête SQL en relation avec notre BD
 *
 * @author Crespin Alexandre / Belabbas Rayane / Enzo Hourlay
 *
 * @package App\Repository
 *
 * @template-extends AbstractRepository
 *
 * @see \App\Model\Billet
 *
 * @version 0.8
 */

namespace App\Repository;

use App\Exception\CannotCreateBilletException;
use App\Exception\NotFoundException;
use App\Model\Billet;

/**
 * Cette class permet de réaliser les actions : get5Billets / deleteBillet / searchBillet / createBillet /
 *  getBilletArrayByAuthor / updateBillet / arrayBilletByCatID
 *
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author HOURLAY-Enzo-2225045a <enzo.hourlay[@]etu.univ-amu.fr>
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 */
class BilletRepository extends AbstractRepository
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
     * Récupération de 5 billets les plus récent
     *
     * Cette fonction permet de récupérer les 5 billet les plus récent pour les afficher ensuite dans Home.php
     *
     * @throws NotFoundException
     *
     * @return array => un array de Billet
     */
    public function get5Billet() : array
    {
        //On select tout les billets ordonnées par leur date de parrussion descendant
        $query = 'SELECT * FROM BILLET ORDER BY DATE_BILLET DESC LIMIT 5';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();
        //Si la requête ne rend rien ça veut dire qu'il n'y a pas de billet ?
        if ( $statement -> rowCount() === 0 ){
            throw new NotFoundException("Aucun BILLET trouvé");
        }

        $arraySQL =  $statement->fetchAll();
        $arrayBillet = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Billet*/
        for ($i = 0; $i < sizeof($arraySQL);$i++){
            $billet = new Billet($arraySQL[$i]['BILLET_ID'],$arraySQL[$i]['TITRE'],$arraySQL[$i]['MSG'],$arraySQL[$i]['DATE_BILLET'],$arraySQL[$i]['USER_ID'],$arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }

        return $arrayBillet;
    }

    /**
     * Suppression d'un Billet
     *
     * Cette fonction permet de supprimer un Billet de la base de donnée
     *
     * @throws NotFoundException
     *
     * @param int $id => l'id du billet
     *
     * @return string
     */
    public function deleteBillet(int $id) : string {
        //On supprime d'abbord les commentaire lier au billet que l'on supprime
        $query = 'DELETE FROM COMMENT WHERE BILLET_ID = :id';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['id' => $id]);

        //Une fois les commentaire supprimer on Supprime lme billet
        $query = 'DELETE FROM BILLET WHERE BILLET_ID = :id';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['id' => $id]);

        //Si la requête ne renvoie rien ça veut dire que le billet n'existe pas
        if ( $statement -> rowCount() === 0){
            throw new  NotFoundException("Le BILLET d'id : ".$id." ne peut pas être supprimé");
        }

       return "Le BILLET d'id : ".$id." a bien été supprimé";
    }

    /**
     * fonction : searchBillet
     *
     * Cette fonction permet de récupérer les billets dont le titre a $recherche
     *
     * @throws NotFoundException
     *
     * @param string $recherche => l'id du billet
     *
     * @return array
     */
    public function searchBillet(string $recherche) : array
    {
        //On select les billet qui ont un titre qui comporte $recherche
        $query = 'SELECT * FROM BILLET WHERE TITRE LIKE "%' . $recherche . '%" ORDER BY BILLET_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();

        //Si la requête ne renvoi rien ça veut dire qu'aucun titre n'a $recherche en lui
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucun billet trouvé pour : '.$recherche.' ...');
        }

        //on créer un tableau de billet contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayBillet = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Billet*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $billet = new Billet($arraySQL[$i]['BILLET_ID'],$arraySQL[$i]['TITRE'], $arraySQL[$i]['MSG'], $arraySQL[$i]['DATE_BILLET'], $arraySQL[$i]['USER_ID'], $arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }

        return $arrayBillet;
    }

    /**
     * fonction : createBillet
     *
     * Cette fonction crée un billet
     *
     * @param string $title => Titre du billet
     * @param string $msg => texte présent dans le billet
     * @param string  $dateBillet => date de création du billet
     * @param int $authorId => l'id de l'autheur du billet
     * @param int $categoryId => l'id de la categorie du billet
     *
     * @throws CannotCreateBilletException
     *
     * @return string
     * @todo que les infos ne soit pas vide
     */
    public function createBillet(string $title, string $msg,string $dateBillet,int $authorId,int $categoryId) : string {
        //on insert dans la BD le nouveau billet
        $query = 'INSERT INTO BILLET (TITRE, MSG, DATE_BILLET, USER_ID, CAT_ID) VALUES (:title, :msg, :date_billet, :authorId, :categoryId)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['title' => $title, 'msg' => $msg, 'date_billet' => $dateBillet, 'authorId' => $authorId, 'categoryId' => $categoryId]);

        //si la requête renvoie rien ça veut dire qu'il y un bug dans la bd
        if ($statement -> rowCount() === 0 ){
            throw new CannotCreateBilletException("Le Billet de titre : ".$title." ne peut pas être créer");
        }

        return "Le Billet de titre : ".$title." a bien été créer";
    }

    /**
     * fonction : getBilletArrayByAuthor
     *
     * Cette fonction récupère les billet fait par un auteur particulier
     *
     * @param int $authorId => l'id de l'auteur du billet
     *
     * @throws NotFoundException
     *
     * @return array
     */
    public function getBilletArrayByAuthor(int $authorId) : array {
        //on select tout les billet d'un auteur
        $query = 'SELECT * FROM BILLET WHERE USER_ID = :authorId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['authorId' => $authorId]);

        //Si la requête ne rend rien cela veut dire que l'auteur n'a pas écrit de billet
        if ($statement -> rowCount() === 0 ){
            throw new NotFoundException("Aucun BILLET trouvé");
        }

        //on créer un tableau de billet contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayBillet = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Billet*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $billet = new Billet($arraySQL[$i]['BILLET_ID'],$arraySQL[$i]['TITRE'], $arraySQL[$i]['MSG'], $arraySQL[$i]['DATE_BILLET'], $arraySQL[$i]['USER_ID'], $arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }

        return $arrayBillet;
    }

    /**
     * fonction : updateBillet
     *
     * Cette fonction modifie un billet
     *
     * @param string $oldTitle => ancien titre du billet
     * @param string $title => Titre du billet
     * @param string $msg => texte présent dans le billet
     * @param string $dateBillet => date de création du billet
     * @param int $authorId => l'id de l'autheur du billet
     * @param int $categoryId => l'id de la categorie du billet
     *
     * @return string
     * @throws NotFoundException
     *
     *  @todo que ce soit par rapport à l'id du billet et non son ancien titre
     */
    public function updateBillet(string $oldTitle,string $title,string $msg,string $dateBillet,int $authorId,int $categoryId) : string
    {
        //on modifie toutes les valeur d'un billet
        $query = 'UPDATE BILLET SET TITRE = :title, MSG = :msg, DATE_BILLET = :date, USER_ID = :authorID, CAT_ID = :catID WHERE TITRE = :oldTitle';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['title' => $title, 'msg' => $msg, 'date' => $dateBillet, 'authorID' => $authorId, 'catID' => $categoryId, 'oldTitle' => $oldTitle]);
        //si la requête renvoie rien c'est que l'on a pas trouver le billet
        if ($statement->rowCount() === 0) {
            throw new NotFoundException("Aucun BILLET de titre : ".$oldTitle);
        }

        return "Le Billet de titre : ".$title." a bien été modifier";
    }

    /**
     * fonction : arrayBilletByCatID
     *
     * Cette fonction récupère les billet fait par un auteur particulier
     *
     * @param int $id => l'id de la categorie du billet
     *
     * @throws NotFoundException
     *
     * @return array
     */
    public function arrayBilletByCatID(int $id) : array {
        //on select tout les billet qui ont une categorie d'id $id
        $query = 'SELECT * FROM BILLET , CATEGORIE WHERE BILLET.CAT_ID = CATEGORIE.CAT_ID AND CATEGORIE.CAT_ID = :id';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['id'=>$id]);

        //si la requête rend rien c'est que l'id n'est pas trouvable
        if ($statement->rowCount() === 0) {
            throw new NotFoundException("Aucun BILLET trouvé");
        }

        //on créer un tableau de billet contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayBillet = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Billet*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $billet = new Billet($arraySQL[$i]['BILLET_ID'],$arraySQL[$i]['TITRE'], $arraySQL[$i]['MSG'], $arraySQL[$i]['DATE_BILLET'], $arraySQL[$i]['USER_ID'], $arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }

        return $arrayBillet;
    }

    public function getBilletFromId(int $billetId): Billet
    {
        $query = 'SELECT * FROM BILLET WHERE BILLET_ID = :billetId';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute(['billetId'=>$billetId]);

        //si la requête rend rien c'est que l'id n'est pas trouvable
        if ($statement->rowCount() === 0) {
            throw new NotFoundException("Aucun BILLET trouvé");
        }

        $resultSQL = $statement->fetch();

        return new Billet($resultSQL['BILLET_ID'],$resultSQL['TITRE'],$resultSQL['MSG'],$resultSQL['DATE_BILLET'],$resultSQL['USER_ID'],$resultSQL['CAT_ID']);
    }
}