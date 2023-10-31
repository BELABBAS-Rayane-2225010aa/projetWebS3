<?php
/**
 * Repository de la class User
 *
 * Cette class permet de faire toutes les requête SQL en relation avec notre BD
 *
 * @author Belebbas Rayane / Crespin Alexandre / Enzo Hourlay
 *
 * @see \App\Model\Category
 *
 * @package App\Repository
 *
 * @template-extends AbstractRepository
 *
 * @version 0.9
 */

namespace App\Repository;

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CatAlreadyExistException;
use App\Exception\NotFoundException;
use App\Model\Category;

/**
 * Cette class permet de réaliser les actions : createCat / deleteCat / getCat / searchCat / labelFromCatID / catIDFromLabel / getCategorieInstance
 *
 * @author BELABBAS-Rayane-2225010aa <rayane.belabbas[@]etu.univ-amu.fr>
 * @author CRESPIN-Alexandre-2225022aa <alexandre.crespin[@]etu.univ-amu.fr>
 * @author HOURLAY-Enzo-2225045a <enzo.hourlay[@]etu.univ-amu.fr>
 */
class CategoryRepository extends AbstractRepository
{
    /**
     * Le constructeur de la classe CategoryRepository
     *
     * on appelle le constructeur de la class parent AbstractRepository
     * pour récupérer la connexion à la BD
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fonction ; createCat
     *
     * Cette fonction permet de créer une catégorie
     *
     * @param string $label => titre de la catégorie
     * @param string $description => déscription
     *
     * @throws CannotCreateCatException | CatAlreadyExistException
     *
     * @return string
     */
    public function createCat(string $label, string $description) : string {
        //On vérifie si une catégorie du même label existe deja
        $query = 'SELECT * FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label]);

        //Si elle n'existe pas :
        if ( $statement -> rowCount() === 0) {

            //On crée le la catégorie
            $query = 'INSERT INTO CATEGORIE (LABEL, DESCRIPTION) VALUES (:label,:description)';
            $statement = $this->connexion->prepare(
                $query);
            $statement->execute(['label' => $label, 'description' => $description]);

            if ($statement->rowCount() === 0) {
                throw new CannotCreateCatException("CATEGORY ".$label." cannot be created");
            }
        }
        else {
            throw new CatAlreadyExistException("CATEGORY ".$label." already exist");
        }

        return "CATEGORY ".$label." successfully created";
    }

    /**
     * Fonction ; deleteCat
     *
     * Cette fonction permet de supprimer une catégorie
     *
     * @param string $label => titre de la catégorie
     *
     * @throws CannotDeleteCatException
     *
     * @return string
     */
    public function deleteCat(string $label) : string {
        //On doit gerer les billet de cette categorie
        $catId = $this->CatIDFromLabel($label);

        //D'abord on place les billet dont la catégorie qui va se faire supprimer dans une catégorie spéciale noCat
        $query = 'UPDATE BILLET SET CAT_ID = 3 WHERE CAT_ID = :oldId';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['oldId' => $catId]);

        //On supprimme la catégorie
        $query = 'DELETE FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label]);

        //Si la requête ne renvoie rien c'est que le label renseigner n'existe pas
        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteCatException("There is no CATEGORY with the name ".$label);
        }

        return "CATEGORY ".$label." successfully deleted";
    }

    /**
     * Récupération des catégories
     *
     * Cette fonction permet de récupéré les catégories de la base de donnée
     *
     * @throws NotFoundException
     *
     * @return array
     */
    public function getCat() : array{
        //On select tout les catégorie
        $query = 'SELECT * FROM CATEGORIE';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();
        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Category not found");
        }

        //on créer un tableau SQL contenant toutes les données
        $arrayCat = $statement->fetchAll();

        return $arrayCat;
    }

    /**
     * Fonction : searchCat
     *
     * Cette fonction permet de récupéré les catégories don tle label possède $recherche
     *
     * @param string $recherche
     *
     * @return array
     *@throws NotFoundException
     *
     */
    public function searchCat(string $recherche) : array
    {
        //On select toute les catégorie qui possède $recherche dans leur label
        $query = 'SELECT * FROM CATEGORIE WHERE LABEL LIKE "%' . $recherche . '%" ORDER BY CAT_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();

        //Si la requête ne renvoie rien c'est qu'aucun label ne contient $recherche
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucune categorie trouvé pour '.$recherche.' .');
        }

        //on créer un tableau de catégorie contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayCat = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Catégorie*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $cat = new Category($arraySQL[$i]['CAT_ID'], $arraySQL[$i]['LABEL'], $arraySQL[$i]['DESCRIPTION']);
            $arrayCat[] = $cat;
        }

        return $arrayCat;
    }

    /**
     * Fonction : catFromID
     *
     * Cette fonction permet de récupéré les catégories don tle label possède $recherche
     *
     * @param int $id
     *
     * @return Category
     *@throws NotFoundException
     *
     */
    public function catFromID (int $id) :Category {
        //On select les catégorie par rapport a son id
        $query = 'SELECT DISTINCT * FROM CATEGORIE WHERE  CATEGORIE.CAT_ID = :id';
        $statement = $this->connexion->prepare(
            $query);
        $statement ->execute(['id'=>$id]);

        // si la reqête ne renvoie rien c'est que la catégorie n'existe pas
        if ($statement->rowCount()===0){
            throw new NotFoundException('Categorie introuvable');
        }
        $cat = $statement->fetch();

        return new Category($cat['CAT_ID'],$cat['LABEL'],$cat['DESCRIPTION']);
    }

    /**
     * Fonction : catIDFromLabel
     *
     * Cette fonction permet de récupéré les catégories don tle label possède $recherche
     *
     * @param string $label
     *
     * @return int
     *@throws NotFoundException
     *
     */
    public function catIDFromLabel (string $label) : int {
        //On select la categoeir d'après son label
        $query = 'SELECT DISTINCT * FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion->prepare(
            $query);
        $statement ->execute(['label' => $label]);

        //Si la requête ne renvoie rien c'est que le label donné en'existe pas
        if ($statement->rowCount()===0){
            throw new NotFoundException('Categorie introuvable');
        }
        $cat = $statement->fetch();

        return $cat['CAT_ID'];
    }

    /**
     * Fonction : getCategorieInstance
     *
     * Cette fonction permet de récupéré toutes les catégories de la base de donnée mais en créant une instance
     *
     * @throws NotFoundException
     *
     * @return array
     */
    public function getCategorieInstance() : array{
        //On select tout les catégorie
        $query = 'SELECT * FROM CATEGORIE';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();

        //si la requête ne renvoie rien c'est qu'il n'y a aucune catégorie
        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Category not found");
        }

        //on créer un tableau de catégorie contenant toutes les données
        $arraySQL = $statement->fetchAll();
        $arrayCat = array();

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Catégorie*/
        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $cat = new Category($arraySQL[$i]['CAT_ID'], $arraySQL[$i]['LABEL'], $arraySQL[$i]['DESCRIPTION']);
            $arrayCat[] = $cat;
        }
        return $arrayCat;
    }
}