<?php

namespace Core;

//require_once ("Utilities.php");

class Autoloader
{
//    use Utilities;

    /**
     * Enregistre notre autoloader
     */
    public function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclus le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    private function autoload($class){
//        $temp = new \ReflectionClass($class);
//        vardump($temp);
//        echo $class."<br>";

        $pathItems = explode('\\', $class);
//        vardump(end($pathItems));
        $file = end($pathItems);
//        $filePath = $this->lycos($file . ".php", ROOT);
//        vardump($filePath);

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