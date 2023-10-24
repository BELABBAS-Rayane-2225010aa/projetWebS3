<?php

namespace App\Repository;

use App\Exception\CannotCreateBilletException;
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

    /* TODO: Idée de comment filtrer
    public function getFiltredBillet($id,$title,$category etc ...) : Billet
    {
        $query = 'SELECT * FROM BILLET';
        if(isset($id){
            $query+='WHERE id = :id';
        } elseif(isset($title)){
            $query+='WHERE title = :title'
        } etc ...
        $statement = $this->connexion ->prepare(
            $query );
        $statement->execute(['id' => $id]);
        if ( $statement -> rowCount() === 0 ){
            throw new NotFoundException("BILLET not Found");
        }
        $billet = $statement->fetch();
        return new Billet($billet['TITRE'],$billet['MSG'],$billet['DATE_BILLET'],$billet['USER_ID'],$billet['CAT_ID']);
    }*/

    public function createBillet($title,$msg,$authorId,$categoryId) : void{
        $date_billet = date("Y-m-d H:i:s");
        $query = 'INSERT INTO BILLET (TITRE, MSG, DATE_BILLET, USER_ID, CAT_ID) VALUES (:title, :msg, :date_billet, :authorId, :categoryId)';
        $statement = $this->connexion ->prepare(
            $query );
        $statement->execute(['title' => $title, 'msg' => $msg, 'date_billet' => $date_billet, 'authorId' => $authorId, 'categoryId' => $categoryId]);
        if ($statement -> rowCount() === 0 ){
            throw new CannotCreateBilletException("Billet cannot be created");
        }
    }
}