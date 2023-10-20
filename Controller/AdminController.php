<?php

namespace App\Controller;

use App\Exception\CannotCreateCatException;
use App\Repository\CategoryRepository;

class AdminController
{
    public function createCategory() : void {
        $name = $_POST['catName'];
        $desc = $_POST['catDesc'];
        try {
            $cat = new CategoryRepository();
            $cat->createCat($name,$desc);
        }
        catch (CannotCreateCatException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}