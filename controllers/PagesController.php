<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 10:01
 */

namespace Controllers;


class PagesController
{
    public static function index($pCible){

        switch ($pCible){
            case("site");
                echo "Page d'accueil";
                break;

            default;
                echo "Erreur 404 : vous essayez d'accéder à une ressource non autorisée";
                break;
        }
    }


}