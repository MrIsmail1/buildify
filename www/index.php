<?php

namespace App;

use App\Core\InstallerCore;
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
if (str_starts_with($uri, '/bdfy-admin/installer') && !InstallerCore::checkInstalled()) {
    require("./Installer/installer.php");
} else {
    $routing = new Routing();
    $routing->setAction($uri);
    $routing->run();
}
