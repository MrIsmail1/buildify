<?php

namespace App\Core;

class Security
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function isUserConnected(): bool
    {
        if (isset($_COOKIE['token'])) {
            return true; // User is connected
        }
        return false; // User is not connected
    }

    public function checkRoute($route): bool
    {
        if (isset($this->routes[$route])) {
            $security = $this->routes[$route]['security'] ?? false;

            // Check if the route requires authentication
            if ($security === true) {
                // Check if the user is connected (token is present and valid)
                if ($this->isUserConnected()) {
                    return true;
                } else {
                    header("location:/login");
                    return false;
                }
            }

            return true; // Route does not require authentication
        }

        return false; // Route not found
    }
}
