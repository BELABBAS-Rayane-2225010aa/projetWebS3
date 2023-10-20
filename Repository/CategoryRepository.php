<?php

namespace App\Repository;

use App\Exception\CannotCreateCatException;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCat(string $label, string $description) : void {
        //TODO : faire en sorte que si la category existe dejà on enpeche la création
        $query = 'INSERT INTO CATEGORIE (LABEL, DESCRIPTION) VALUES (:label,:description)';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute(['label' => $label, 'description'=> $description]);

        if ( $statement -> rowCount() === 0){
            throw new CannotCreateCatException("CATEGORY cannot be created");
        }
    }
}