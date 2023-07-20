<?php
namespace App\Controllers;

use App\Core\Db;
use App\Models\Dashboard;
use App\Core\View;

class DashController
{
    
    public function dashboard() 
    {

        if (!isset($_COOKIE['token'])) {
            header('Location: /auth');
            exit;
        }
        
        $dashboardModel = new Dashboard();

        $totalPages = $dashboardModel->getTotalPages();
        $totalComments = $dashboardModel->getTotalComments();
        $lastComments = $dashboardModel->getLastComments();
        
        $lastPages = $dashboardModel->getLastPages();
        

        // Récupérez les données du tableau de bord à afficher dans la vue
        $dashboardModel = Dashboard::getInstance();    
        $view = new View("Dashboard/dashboard", "back");
        $view->assign('totalPages', $totalPages);
        $view->assign('totalComments', $totalComments);
        $view->assign('lastComments', $lastComments);
        $view->assign('lastPages', $lastPages);
        

    }
}
?>