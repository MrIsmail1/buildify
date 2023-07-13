<?php

namespace App\Core;

class Routing
{
    private $routeFile = "routes.yml";
    private $routes = [];
    private $controller;
    private $action;
    private $security;

    public function __construct()
    {
        if (!file_exists($this->routeFile)) {
            die("Fichier " . $this->routeFile . " introuvable");
        }
        $this->routes = yaml_parse_file($this->routeFile);
        $this->security = new Security($this->routes);
    }

    public function setAction(string $uri): array
    {
        if (
            empty($this->routes[$uri])
            || empty($this->routes[$uri]["controller"])
            || empty($this->routes[$uri]["action"])
        ) {
            http_response_code(404);
            die("404 page not found");
        }

        // Check if the user is connected for the route
        if ($this->security->checkRoute($uri)) {
            // User is connected, proceed with the route logic
            $this->controller = $this->routes[$uri]["controller"];
            $this->action = $this->routes[$uri]["action"];
        } else {
            // User is not connected, handle the unauthorized access
            http_response_code(401);
            die("Unauthorized access");
        }

        return [$this->controller, $this->action];
    }

    public function getUri(string $controller, string $action): ?string
    {
        foreach ($this->routes as $uri => $routing) {
            if (
                $routing["controller"] == $controller &&
                $routing["action"] == $action
            )
                return $uri;
        }
        return null;
    }

    public function run(): void
    {

        if (!file_exists("Controllers/" . $this->controller . ".php")) {
            http_response_code(404);
            die("Le fichier Controllers/" . $this->controller . ".php n'existe pas");
        }

        include "Controllers/" . $this->controller . ".php";

        $controller = "\\App\\Controllers\\" . $this->controller;
        if (!class_exists($controller)) {
            http_response_code(404);
            die("La class " . $controller . " n'existe pas");
        }

        $object = new $controller();

        $action = $this->action;

        if (!method_exists($object, $action)) {
            http_response_code(404);
            die("L'action " . $action . " n'existe pas");
        }
        $object->$action();
    }
}
