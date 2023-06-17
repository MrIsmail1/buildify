<?php

namespace App;

use App\Core\Routing;

define('ROOT', dirname(
    __DIR__
));



spl_autoload_register(function ($class) {

    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", "/", $class) . ".php";
    if (file_exists($class)) {
        include $class;
    }
});

$uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])), "/");
$uri = (empty($uri)) ? "/" : $uri;



$routing = new Routing();
$routing->setAction($uri);
$routing->run();
?>