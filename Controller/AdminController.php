<?php

namespace App\Controller;

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteBilletException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CannotDeleteUserException;
use App\Exception\CannotModify;
use App\Repository\BilletRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

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

    public function deleteCategory() : void {
        $name = $_POST['catName'];
        try {
            $cat = new CategoryRepository();
            $cat->deleteCat($name);
        }
        catch (CannotDeleteCatException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function deleteUser() : void {
        $userId = $_POST['userId'];
        try {
            $user = new UserRepository();
            $user->deleteUs($userId);
        }
        catch (CannotDeleteUserException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function deleteBillet() : void {
        $billetId = $_POST['billetId'];
        try {
            $user = new BilletRepository();
            $user->deleteBillet($billetId);
        }
        catch (CannotDeleteBilletException $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }

    public function MakeAdmin() : void {
        $userId = $_POST['userIdAdmin'];
        try {
            $user = new UserRepository();
            $user->makeAdmin($userId);
        }
        catch (CannotModify $ERROR){
            file_put_contents('Log/[PlaceHolderName].log', $ERROR->getMessage()."\n",FILE_APPEND | LOCK_EX);
            exit();
        }
    }
}