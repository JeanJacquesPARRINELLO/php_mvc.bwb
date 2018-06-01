<?php

namespace Core;


class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclus le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){

//        echo $class."<br>";

        $pathItems = explode('\\', $class);

        $filePath = ROOT;
        for ($i = 0 ; $i < count($pathItems) ; $i++) {
            if ($i < count($pathItems) - 1){
                $filePath.= strtolower($pathItems[$i]) . '/';
            }else{
                $filePath.= $pathItems[$i] . '.php';
            }
        }
//        echo ($filePath);
        if(file_exists($filePath) && is_readable($filePath)) require $filePath;
    }

}