<?php

namespace App\Repository;

use App\Exception\NotFoundException;

class BilletRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get5Billet() : array
    {
        $query = 'SELECT * FROM BILLET ORDER BY DATE_BILLET DESC LIMIT 5';
        $statement = $this->connexion -> prepare(
            $query );
        $statement->execute();
        if ( $statement -> rowCount() === 0 ){
            throw new NotFoundException("BILLET not Found");
        }
        return $statement->fetchAll();
    }
}