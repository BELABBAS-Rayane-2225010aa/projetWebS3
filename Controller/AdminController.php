<?php

namespace App\Controller;

require '../vendor/autoload.php';

use App\Exception\CannotCreateCatException;
use App\Exception\CannotDeleteBilletException;
use App\Exception\CannotDeleteCatException;
use App\Exception\CannotDeleteUserException;
use App\Exception\CannotModify;
use App\Exception\CatAlreadyExistException;
use App\Exception\UserIsAdminException;
use App\Repository\BilletRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

class AdminController
{
    public function createCategory() : void {
        $name = $_POST['newCatName'];
        $desc = $_POST['catDesc'];
        try {
            $cat = new CategoryRepository();
            $msg = $cat->createCat($name,$desc);
        }

        catch (CannotCreateCatException | CatAlreadyExistException $ERROR){
            $msg = $ERROR->getMessage();
        }

        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    public function deleteCategory() : void {
        $name = $_POST['catName'];
        try {
            $cat = new CategoryRepository();
            $msg = $cat->deleteCat($name);
        }
        catch (CannotDeleteCatException $ERROR){
            $msg = $ERROR->getMessage();
        }

        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    public function deleteUser() : void {
        $userId = $_POST['userId'];
        try {
            $user = new UserRepository();
            $msg = $user->deleteUs($userId);
        }
        catch (CannotDeleteUserException | UserIsAdminException $ERROR){
            $msg = $ERROR->getMessage();
        }

        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    public function deleteBillet() : void {
        $billetId = $_POST['billetId'];
        try {
            $user = new BilletRepository();
            $msg = $user->deleteBillet($billetId);
        }
        catch (CannotDeleteBilletException $ERROR){
            $msg = $ERROR->getMessage();
        }

        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }

    public function MakeAdmin() : void {
        $userId = $_POST['userIdAdmin'];
        try {
            $user = new UserRepository();
            $msg = $user->makeAdmin($userId);
        }
        catch (CannotModify | UserIsAdminException $ERROR){
            $msg = $ERROR->getMessage();
        }

        file_put_contents('Log/[PlaceHolderName].log', $msg."\n",FILE_APPEND | LOCK_EX);
        if (isset($_SESSION['msg'])){
            unset($_SESSION['msg']);
        }
        $_SESSION['msg'] = $msg;
    }
}