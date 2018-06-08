<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 29/05/18
 * Time: 15:55
 */

namespace Controllers;

use Core\Controller;
use Core\Response;

class ViewsController extends Controller
{

    public static function getHome(){
        $viou = new Accueil_class("accueil.php");
        $viou->setTitle( "Page d'accueil");
        $viou->Render();
    }

    public function error404(){
        $view = new Response("error404.php");
        $view->setTitle( "Page d'erreur 404");
        $view->Render();
    }
}