<?php

use Core\Autoloader;
use Core\Kernel;

define("ROOT" , "./");

require_once("./core/Autoloader.php");

Autoloader::register();
Kernel::getInstance()->main();

//phpinfo();
//vardump($_SERVER['REQUEST_URI']);
//vardump($_SERVER['REQUEST_METHOD']);

function vardump($pWhat){
    echo "<pre>";
    var_dump($pWhat);
    echo "</pre>";
}
?>
