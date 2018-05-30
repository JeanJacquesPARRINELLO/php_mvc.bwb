<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 28/05/18
 * Time: 10:16
 */

namespace Core;

class Connexion
{
//
    private static $instance = null;
    private $config;


    public static function getInstance(){
//      CRÉATION DE L'INSTANCE SI ELLE N'EXISTE PAS
//      SELF FAIT RÉFÉRENCE À LA CLASSE
        if(!isset(self::$instance)){

            $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $this->config = $this->getConfig();

//          INSTANCIATION DE L'ATTRIBUT D'INSTANCE DE LA CLASSE Db
//            self::$instance = new PDO("mysql:host=local;dbname=".DATABASE, USERNAME, PASSWORD, $option);
            self::$instance = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD, $option);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            self::$instance->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        }
        return self::$instance;
    }

    private function getConfig(){
        $this->config = file_get_contents(ROOT."config\\database.json");
    }
}