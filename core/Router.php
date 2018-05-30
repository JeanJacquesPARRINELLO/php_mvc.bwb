<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 14:10
 */

namespace Core;

use Controllers\PagesController;

class Router
{
    private $fileConfig;
    private $routes;

    /**
     *  ROUTAGE DE LA REQUÊTE VERS LE CONTROLEUR IDOINE
     */
    public function index()
    {
        //  RÉCUPÉRATION DES ROUTES ET INIT DE L'ATTRIBUT $routes
        $this->getRoutesFromConfig();
//        vardump($this->routes);

        //  INIT DES ROUTES
        $this->routes = $this->setRoutes($_SERVER['REQUEST_URI']);
//        vardump($this->routes);


        //  SUPPRESSION D'UN ÉVENTUEL "/" DE FIN D'URL
        if($_SERVER['REQUEST_URI'] !== "/")
            $_SERVER['REQUEST_URI'] = rtrim($_SERVER['REQUEST_URI'], '/');

        //  CORRESPONDANCE ENTRE LA REQUETE ET UNE ROUTE DÉFINIES
        if(array_key_exists($_SERVER['REQUEST_URI'], $this->routes)){

            //  LA ROUTE NÉCESSITE-ELLE DE CONTROLER LA MÉTHODE HTTP
            if(is_array($this->routes[$_SERVER['REQUEST_URI']])){
                //  LA ROUTE EST-ELLE DÉFINIE POUR LA MÉTHODE HTTP DE LA REQUÊTE
                if(array_key_exists($_SERVER["REQUEST_METHOD"], $this->routes[$_SERVER['REQUEST_URI']])){
                    //  RÉCUPÉRATION DU CONTROLEUR ET DE L'ACTION ASSOCIÉE ET EXÉCUTION
                    $ct = explode(':', $this->routes[$_SERVER['REQUEST_URI']][$_SERVER["REQUEST_METHOD"]]);
                    call_user_func("Controllers\\" . $ct[0] . "::" . $ct[1]);
                }else{
                    $this->routage("error404");
                }
            //  LA ROUTE EST EN LIEN DIRECT AVEC UN CONTROLEUR SANS SE SOUCIER DE LA MÉTHODE HTTP
            }else{
                //  RÉCUPÉRATION DU CONTROLEUR ET DE L'ACTION ASSOCIÉE ET EXÉCUTION
                $ct = explode(':', $this->routes[$_SERVER['REQUEST_URI']]);
                call_user_func("Controllers\\" . $ct[0] . "::" . $ct[1]);
            }
        }else{
            $this->routage("error404");
        }
    }

    /**
     * RÉCUPÉRATION DES ROUTES ET INIT DE L'ATTRIBUT $routes
     * @param void
     * @return void
     */
    private function getRoutesFromConfig()
    {
        $this->fileConfig = file_get_contents(ROOT."config/routing.json");
        $this->routes = json_decode($this->fileConfig,true);
    }

    /**
     *
     * @param string $pUri : Request Uri
     * @return array
     */
    private function setRoutes(string $pUrl)
    {
        $routes = array();
//        $routes = $this->routes;
        $pUrl = explode("/", rtrim($pUrl, '/'));
        if((int)end($pUrl) > 0):
            $id = end($pUrl);
        endif;

        //  MODIFICATION DES ROUTES POUR QU'ELLES RESSEMBLENT À L'URI
        if(isset($id)){
            foreach ($this->routes as $key => $route){
                $Key = str_replace(":id", $id, $key);
                $routes[$Key] = $route;
            }
            return $routes;
        }
        return $this->routes;
    }

    /**
     * @param string $pCible
     */
    private function routage(string $pCible){
        PagesController::index($pCible);
    }
}