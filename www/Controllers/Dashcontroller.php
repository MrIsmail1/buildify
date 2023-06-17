<?php
namespace App\Controllers;

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
    // Instanciez le modèle Dashboard pour récupérer les données du tableau de bord
    $dashboardModel = new Dashboard();

    // Récupérez les données du tableau de bord à afficher dans la vue
    $totalPages = $dashboardModel->getTotalPages();
    $totalPosts = $dashboardModel->getTotalPosts();
    $totalComments = $dashboardModel->getTotalComments();

    // Chargez la vue et transmettez les données
    $view = new View('Dashboard/dashboard', 'back');
    $view->assign('totalPages', $totalPages);
    $view->assign('totalPosts', $totalPosts);
    $view->assign('totalComments', $totalComments);
    $view->render();
    }

    public function index()
    {
        $view = new View("Dashboard/dashboard", "back");
        // Passer des données à la vue si nécessaire
        $view->render();
    }

    public function create()
    {
        $view = new View("create", "back");
        // Passer des données à la vue si nécessaire
        $view->render();
    }
    public function showDashboard()
{
    // Instanciez le modèle Dashboard pour récupérer les données du tableau de bord
    $dashboardModel = new Dashboard();

    // Récupérez les données du tableau de bord à afficher dans la vue
    $totalPages = $dashboardModel->getTotalPages();
    $totalPosts = $dashboardModel->getTotalPosts();
    $totalComments = $dashboardModel->getTotalComments();

    // Chargez la vue et transmettez les données
    $view = new View('dashboard', 'back');
    $view->assign('totalPages', $totalPages);
    $view->assign('totalPosts', $totalPosts);
    $view->assign('totalComments', $totalComments);
    $view->render();
}

}
?>