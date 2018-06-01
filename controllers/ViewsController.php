<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 15:55
 */

namespace Controllers;

use Models\Users;

class ViewsController
{

    public function index($pCible = "accueil"){

        switch ($pCible){
            case("error404"):
                echo "Vous tentez d'accéder à une ressource non autorisée";
                break;
        }
    }

    public static function getHome(){
        echo "Vous tentez d'accéder à l'accueil";
    }

    public static function signinUser(){
        require_once ROOT."views/inscriptionForm.php";
    }

    public static function updateUser(){
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $userIdToModify = end($id);
        $modelUser = new Users();
        $modelUser->setId($userIdToModify);
        $oUser = $modelUser->load();
        require_once ROOT."views/updateUserform.php";
    }

    public static function deleteUser(){
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $userIdToModify = end($id);
        $modelUser = new Users();
        $modelUser->setId($userIdToModify);
        $oUser = $modelUser->load();
        require_once ROOT."views/deleteUser.php";
    }
}