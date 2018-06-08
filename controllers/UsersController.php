<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 23:53
 */

namespace Controllers;

use Core\Controller;
use Core\Response;
use Core\Exception;
use Models\Users;

class UsersController extends Controller
{

    public function getAll(){
        $this->displayAllUsers();
    }

    public function Create(){
        echo 'controller user :: create';
//        $modelUser = new Users();
//        $message = "Création OK";
//        if(isset($this->post['id'])){
//            $modelUser->setId ((int)$this->post['id']);
//            $message = "Update OK";
//        }
//        if($modelUser->update() === false){
//            $view = new Response("errorSql.php");
//        }else{
//            $this->displayAllUsers();
//        }
    }

    public function getById(){
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

    public function displayAllUsers(){

        try
        {
            $modelUser = new Users();
            $datas['users'] = $modelUser->getAll();

            $view = new Response("displayUsers.php", $datas);
            $view->setTitle("Liste des utilisateurs");
            $view->Render();
        }
        catch(\Exception $e)
        {
            new Exception($e);
            exit;
        }
    }

    public function inscriptionForm(){
        $view = new Response("inscriptionUserForm.php");
        $view->setTitle("Inscription d'un nouvel utilisateur");
        $view->Render();
    }

    public function createUserAction(){
        try
        {
            $modelUser = new Users();
            if($modelUser->Create() > 0){
                $datas["message"] = "Le profil utilisateur a bien été créé !";
                $view = new Response("message.php", $datas);
                $view->setTitle("Message de l'application");
                $view->Render();
            }
        }
        catch (\Exception $e)
        {
            new Exception($e);
            exit;
        }

    }

    public function updateForm(){
        try
        {
            //  RÉCUPÉRER LES PARAMÈTRES CONTENUS DANS L'URI
            $userIdToModify = $this->getParamFromUri();

            $modelUser = new Users();
            $modelUser->setId($userIdToModify['user']);
            $aaDatas['users'] = $modelUser->Retrieve();

            $view = new Response("inscriptionUserForm.php", $aaDatas);
            $view->setTitle("Modification d'un profil utilisateur");
            $view->Render();
        }
        catch(\Exception $e)
        {
            new Exception($e);
        }
    }

    public function updateUserAction(){
        try
        {
            //  RÉCUPÉRER LES PARAMÈTRES CONTENUS DANS L'URI
            $userIdToModify = $this->getParamFromUri();

            $modelUser = new Users();
            $modelUser->setId($userIdToModify['user']);
            if($modelUser->Update() > 0){
                $datas["message"] = "Le profil utilisateur a bien été mis à jour !";
                $view = new Response("message.php", $datas);
                $view->setTitle("Message de l'application");
                $view->Render();
            }
        }
        catch(\Exception $e)
        {
            new Exception($e);
            exit;
        }
    }

    public function deleteUserForm(){
        //  RÉCUPÉRER LES PARAMÈTRES CONTENUS DANS L'URI
        $userIdToModify = $this->getParamFromUri();

        $modelUser = new Users();
        $modelUser->setId($userIdToModify['user']);
        $aoUser[] = $modelUser->Retrieve();
//        vardump($aoUser);
        $view = new Response("deleteUserConfirmation.php", $aoUser);
        $view->setTitle("Suppression d'un profil utilisateur");
        $view->Render();
    }

    public function deleteUserAction(){
        try
        {
            //  RÉCUPÉRER LES PARAMÈTRES CONTENUS DANS L'URI
            $userIdToModify = $this->getParamFromUri();

            $modelUser = new Users();
            $modelUser->setId($userIdToModify['user']);
            if($modelUser->Delete() > 0){
                $datas["message"] = "L'utilisateur a bien été supprimé !";
                $view = new Response("message.php", $datas);
                $view->setTitle("Message de l'application");
                vardump($datas);
                $view->Render();
            }

        }
        catch (\Exception $e)
        {
            new Exception($e);
            exit;
        }
    }


    /*
     *      MÉTHODES PRIVÉES
     */

}