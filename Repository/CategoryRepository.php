<?php

namespace App\Repository;

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CatAlreadyExistException;
use App\Exception\NotFoundException;
use App\Model\Category;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCat(string $label, string $description) : string {
        $query = 'SELECT * FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label]);

        if ( $statement -> rowCount() === 0) {
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

    public function deleteCat(string $label) : string {
        $query = 'DELETE FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label]);

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
        $query = 'SELECT * FROM CATEGORIE';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();
        if ( $statement -> rowCount() === 0){
            throw new NotFoundException("Category not found");
        }
        $arrayCat = $statement->fetchAll();
        return $arrayCat;
    }

    public function searchCat(string $q) : array
    {
        $query = 'SELECT * FROM CATEGORIE WHERE LABEL LIKE "%' . $q . '%" ORDER BY CAT_ID DESC';
        $statement = $this->connexion->prepare(
            $query);
        $statement->execute();
        if ($statement->rowCount() === 0) {
            throw new NotFoundException('Aucune categorie trouvé pour '.$q.' .');
        }
        $arraySQL = $statement->fetchAll();
        $arrayUser = array();

        for ($i = 0; $i < sizeof($arraySQL); $i++) {
            $user = new Category($arraySQL[$i]['LABEL'], $arraySQL[$i]['DESCRIPTION']);
            $arrayUser[] = $user;
        }

        return $arrayUser;
    }
}