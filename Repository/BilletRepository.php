<?php
/**
 * Repository de la class Billet
 *
 * Cette class permet de faire toutes les requête SQL en relation avec notre BD
 *
 * @author Crespin Alexandre
 *
 * @see \App\Controller\BilletController
 *
 * @version 0.5
 *
 * @todo : implémenter la récupération des billet par Id
 */

namespace App\Repository;

use App\Exception\NotFoundException;
use App\Model\Billet;

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
     * @return array => un array de Billet
     */
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

        /* on récupére le résultat de la requête SQL et on le met dans un tableau de Billet*/
        for ($i = 0; $i < sizeof($arraySQL);$i++){
            $billet = new Billet($arraySQL[$i]['TITRE'],$arraySQL[$i]['MSG'],$arraySQL[$i]['DATE_BILLET'],$arraySQL[$i]['USER_ID'],$arraySQL[$i]['CAT_ID']);
            $arrayBillet[] = $billet;
        }

        return $arrayBillet;
    }

    /**
     * Récupére le Billet dans la BD qui a le même Id
     *
     * @deprecated pas utilisé dans le cadre de la page Billet
     *
     * @param $id => l'id du billet rechercher
     *
     * @return Billet => un Billet créer a partir des informations de la BD
     *
     * @todo : implémenter cette fonction pour clarifier le code de la page Billet
     */
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