<?php
require '../Model/AutoLoader.php';
Autoloader::register();
abstract class AbstractRepository
{
    protected PDO $connexion ;
    public function __construct()
    {
        $this->connexion = Connexion::getInstance();
    }
}