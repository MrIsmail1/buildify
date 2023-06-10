<?php



class DashboardController {
    public function index() {
        $totalPages = $this->getTotalPages();
        $totalUsers = $this->getTotalUsers();
        // Etc. pour le reste de vos statistiques.
        include 'views/dashboard.php';
    }

    private function getTotalPages() {
        // Interrogez ici votre base de données pour obtenir le nombre total de pages.
    }

    private function getTotalUsers() {
        // Interrogez ici votre base de données pour obtenir le nombre total d'utilisateurs.
    }
}
?>