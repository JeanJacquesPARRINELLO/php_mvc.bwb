<?php

use Core\Autoloader;
use Core\Kernel;

define("ROOT" , "./");

require_once("./core/Autoloader.php");

Autoloader::register();
Kernel::getInstance()->main();

function vardump($pWhat){
    echo "<pre>";
    var_dump($pWhat);
    echo "</pre>";
}
?>
