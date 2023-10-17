<?php

namespace App\Repository;

use App\Exception\NotFoundException;
use App\Model\Billet;

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
        $arraySQL =  $statement->fetchAll();
        $arrayBillet = array();
        for ($i = 0; $i < sizeof($arraySQL);$i++){
            $billet = new Billet($arraySQL[$i]['TITRE'],$arraySQL[$i]['MSG'],$arraySQL[$i]['DATE_BILLET'],$arraySQL[$i]['USER_ID'],$arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }
        return $arrayBillet;
    }

    public function getBillet($id) : Billet
    {
        $query = 'SELECT * FROM BILLET WHERE BILLET_ID = :id';
        $statement = $this->connexion ->prepare(
            $query );
        $statement->execute(['id' => $id]);
        if ( $statement -> rowCount() === 0 ){
            throw new NotFoundException("BILLET not Found");
        }
        $billet = $statement->fetch();
        return new Billet($billet['TITRE'],$billet['MSG'],$billet['DATE_BILLET'],$billet['USER_ID'],$billet['CAT_ID']);
    }
}