<?php

namespace App;

use App\Core\Routing;

session_start();
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
$route = strtok($_SERVER['REQUEST_URI'], '?');
if (str_starts_with($route, '/bdfy-admin/installer')) {
    $basePath = "/bdfy-admin/installer";
    require("./public/installer.php");
} else {
    $routing = new Routing();
    $routing->setAction($uri);
    $routing->run();
}
