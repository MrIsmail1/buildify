<?php

namespace App\Controllers;

use App\Core\View;

class ErrorController
{
    public function NotFound()
    {
        //Gére les erreurs 404
        $view = new View("404/404", "front");
        http_response_code(404);
        return $view;
    }
}
