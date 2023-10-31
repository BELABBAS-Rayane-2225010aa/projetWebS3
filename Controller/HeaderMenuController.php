<?php

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Repository\CategoryRepository;

class HeaderMenuController
{
    private array $catArray = [];

    public function getAllCat() : void
    {
        try {
            $cat = new CategoryRepository();
            $this->catArray = $cat->getCategorieInstance();
        }
        catch (NotFoundException $ERROR){
            file_put_contents('Log/tavernDeBill.log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
        }
    }

    public function getCatArray() : array{
        return $this->catArray;
    }

}