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
        $requiredRole = $this->routes[$route]['role'] ?? null;

        // Check if the route requires authentication
        if ($security === true) {
            // Check if the user is connected (token is present and valid)
            if ($this->isUserConnected()) {
                // If a role is specified for the route, check if the user has that role
                if ($requiredRole !== null && strtolower($_SESSION["user"]["role"]) !== strtolower($requiredRole)) {
                    // User does not have the required role
                    http_response_code(403);
                    header("location: /404");
                }
                return true;
            } else {
                header("location: /dashboard");
                return false;
            }
        }

        return true; // Route does not require authentication
    }

    return false; // Route not found
}

}
