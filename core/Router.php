<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 14:10
 */

namespace Core;

use Controllers\ViewsController;
//use Controllers\UsersController;

class Router
{
    private $fileConfig;
    private $routes;
    private $uri;

    public function __construct()
    {
        //  SUPPRESSION D'UN ÉVENTUEL "/" DE FIN D'URL
        if($_SERVER['REQUEST_URI'] !== "/"){
            $this->uri = rtrim($_SERVER['REQUEST_URI'], '/');
        }else{
            $this->uri = $_SERVER['REQUEST_URI'];
        }

        //  RÉCUPÉRATION DES ROUTES ET INIT DE L'ATTRIBUT $routes
        $this->routes = $this->getRoutesFromConfig();

        //  INIT DES ROUTES
        $this->routes = $this->setRoutes($this->uri);

        $this->execute();
    }

    /**
     *  ROUTAGE DE LA REQUÊTE VERS LE CONTROLEUR IDOINE
     */
    public function execute()
    {

        //  CORRESPONDANCE ENTRE LA REQUETE ET UNE ROUTE DÉFINIES
        if(array_key_exists($this->uri, $this->routes)){

            //  LA ROUTE NÉCESSITE-ELLE DE CONTROLER LA MÉTHODE HTTP
            if(is_array($this->routes[$this->uri])){
                //  LA ROUTE EST-ELLE DÉFINIE POUR LA MÉTHODE HTTP DE LA REQUÊTE
                if(array_key_exists($_SERVER["REQUEST_METHOD"], $this->routes[$this->uri])){
                    //  RÉCUPÉRATION DU CONTROLEUR ET DE L'ACTION ASSOCIÉE ET EXÉCUTION
                    $ct = explode(':', $this->routes[$this->uri][$_SERVER["REQUEST_METHOD"]]);
//                    call_user_func("Dao\\" . $ct[0] . "::" . $ct[1]);
                }else{
                    $this->invoke(array("Controllers\ViewsController", "error404"));
                }
            //  LA ROUTE EST EN LIEN DIRECT AVEC UN CONTROLEUR SANS SE SOUCIER DE LA MÉTHODE HTTP
            }else{
                //  RÉCUPÉRATION DU CONTROLEUR ET DE L'ACTION ASSOCIÉE ET EXÉCUTION
                $ct = explode(':', $this->routes[$this->uri]);
            }
            $this->invoke($ct);
        }else{
            $this->invoke(array("Controllers\ViewsController", "error404"));
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
        return json_decode($this->fileConfig,true);
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
        array_shift($pUrl);
//        vardump($pUrl);
        $aIntParams = [];
        for($i = 0 ; $i < count($pUrl); $i++){
            if((int)$pUrl[$i] > 0){
                $aIntParams[$i] = $pUrl[$i];
            }
        }
//        vardump($aIntParams);

        //  MODIFICATION DES ROUTES POUR QU'ELLES RESSEMBLENT À L'URI
        if(!empty($aIntParams)){
            foreach ($this->routes as $route => $controller){
                $road = explode("/", $route);
//                vardump($road);
                array_shift($road);
                if(count($road) == count($pUrl)){
                    foreach($aIntParams as $pos => $int){
                        if(array_key_exists($pos, $road) && $road[$pos] == ":id"){
                            $road[$pos] = $int;
                        }
                    }
                    $routes["/" . implode("/", $road)] = $controller;
                }else{
                    $routes[$route] = $controller;
                }
//                $oneRoute = explode($route);
            }
            return $routes;
        }
//            vardump($this->routes);
        return $this->routes;
    }

    /**
     * @param array $paCible
     * @param array|null $paGet
     * @param array|null $paPost
     */
    private function invoke(array $paCible){
        $temp = $paCible[0];
        $controller = new $temp($_GET, $_POST, $_SERVER['REQUEST_URI']);
        $controller->{$paCible[1]}();
    }
}