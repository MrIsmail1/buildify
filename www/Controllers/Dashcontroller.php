<?php
namespace App\Controllers;

use App\Core\Db;
use App\Models\Dashboard;
use App\Core\View;

class DashController
{
    
    public function dashboard() 
    {

        /*if (!isset($_COOKIE['token'])) {
            header('Location: /auth');
            exit;
        }*/
   

    // Récupérez les données du tableau de bord à afficher dans la vue
    $dashboardModel = Dashboard::getInstance();    
    $view = new View("Dashboard/dashboard", "back");  
    }
}
?>