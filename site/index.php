<?php

namespace App;


spl_autoload_register(function ($class) {
    //Core/View.php
    $class = str_replace("App\\", "", $class);
    $class = str_replace("\\", "/", $class) . ".php";
    if (file_exists($class)) {
        include $class;
    }
});

$uriExploded = explode("?", $_SERVER["REQUEST_URI"]);
$uri = rtrim(strtolower(trim($uriExploded[0])), "/");
$uri = (empty($uri)) ? "/" : $uri;

if (!file_exists("routes.yml")) {
    die("Le fichier de routing n'existe pas");
}

$routes = yaml_parse_file("routes.yml");

//Page 404
if (empty($routes[$uri])) {
    http_response_code(404);
}

if (empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])) {
    die("Absence de controller ou d'action dans le ficher de routing pour la route " . $uri);
}

$controller = $routes[$uri]["controller"];
$action = $routes[$uri]["action"];

if (!file_exists("Controllers/" . $controller . ".php")) {
    die("Le fichier Controllers/" . $controller . ".php n'existe pas");
}

include "Controllers/" . $controller . ".php";

$controller = "\\App\\Controllers\\" . $controller;
if (!class_exists($controller)) {
    die("La class " . $controller . " n'existe pas");
}

$objet = new $controller();

if (!method_exists($objet, $action)) {
    die("L'action " . $action . " n'existe pas");
}

$objet->$action();
