<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 15:55
 */

namespace Controllers;

use Models\Users;
use views\Accueil_class;
use views\DeleteUserConfirmation_class;
use views\Padviou;

class ViewsController
{

    public function index($pCible = "accueil"){

        switch ($pCible){
            case("error404"):
                $view = new Padviou("error404.php");
                $view->Render();
        }
    }

    public static function getHome(){
        $viou = new Accueil_class("accueil.php");
        $viou->Render();
    }

    public static function signinUser(){
        $view = new Padviou("inscriptionUserForm.php");
        $view->setTitle("Inscription d'un nouvel utilisateur");
        $view->Render();
    }

    public static function updateUser(){
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $userIdToModify = end($id);
        $modelUser = new Users();
        $modelUser->setId($userIdToModify);
        $oUser = $modelUser->load();
        $view = new Padviou("updateUserform.php");
        $view->Render();
    }

    public static function deleteUser(){
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $userIdToModify = end($id);
        $modelUser = new Users();
        $modelUser->setId($userIdToModify);
        $oUser = $modelUser->load();
//        vardump($oUser);
        $view = new DeleteUserConfirmation_class("deleteUserConfirmation.php");
        $view->setUser($oUser);
        $view->Render();
    }
}