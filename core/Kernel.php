<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 10:59
 */

namespace Core;

class Kernel{

    private static $_instance = null;


    private function __construct()
    {

    }

    public function getInstance()
    {
        if(self::$_instance === null){
            self::$_instance = new Kernel();
        }
        return self::$_instance;
    }

    /**
     * Point d'entrée de l'application
     * @param void
     * @return void
     */
    public function main()
    {
        $router = new Router();
        $router->index();
//        $router->indexOld();
    }
}