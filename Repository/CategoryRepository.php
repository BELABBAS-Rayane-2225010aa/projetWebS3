<?php

namespace App\Repository;

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CatAlreadyExistException;
use App\Exception\CatSuccesfullyCreatedException;

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

    public function deleteCat(string $label) : void {
        $query = 'DELETE FROM CATEGORIE WHERE LABEL = :label';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label]);

        if ( $statement -> rowCount() === 0){
            throw new CannotDeleteCatException("CATEGORY cannot be deleted");
        }
    }
}