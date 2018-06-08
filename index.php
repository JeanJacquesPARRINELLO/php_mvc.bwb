<?php

use Core\Autoloader;
use Core\Router;

define("ROOT" , "./");

require_once("./core/Autoloader.php");

$autoloader = new Autoloader();
$autoloader->register();
$router = new Router();



//phpinfo();

function vardump($pWhat){
    echo "<pre>";
    var_dump($pWhat);
    echo "</pre>";
}
?>
