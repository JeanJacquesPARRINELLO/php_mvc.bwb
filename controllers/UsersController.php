<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 23:53
 */

namespace Controllers;

use Models\Users;
use views\Padviou;

class UsersController
{

    function getAll(){
        $aoUser = [];
        $modelUser = new Users();
        $aoResult = $modelUser->getAll();

        $view = new Padviou("inscriptionUserForm.php", "Tous les utilisateur");
        $view->Render("callback");
//        vardump($aoResult);
    }

    function Create(){
//        echo 'controller user :: create';
        $modelUser = new Users();
        $message = "Création OK";
        if(isset($_POST['id'])){
            $modelUser->setId ((int)$_POST['id']);
            $message = "Update OK";
        }
        $modelUser->update();
        echo $message;
    }

    function getById(){
        $id = explode("/", $_SERVER["REQUEST_URI"]);
        $id = (int)end($id);
        $modelUser = new Users();
        $modelUser->setId($id);
        $oUser = $modelUser->load();
        vardump($oUser);
    }

    public function delete(){
        $id = explode("/", $_SERVER["REQUEST_URI"]);
        $id = (int)end($id);
        $modelUser = new Users();
        $modelUser->setId($id);
        $oUser = $modelUser->remove();
        vardump($oUser);
    }

    public function deleteAll(){
        echo "public static function deleteAll dans UsersController";
    }

}