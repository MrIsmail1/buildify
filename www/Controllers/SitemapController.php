<?php

namespace App\Controllers;

use App\Models\Page; // Remplacez par votre modèle correspondant aux pages

class SitemapController {

    public function ViewSitemap() {

        // Définition du type de contenu en tant que XML
        header("Content-type: text/xml");

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Logique pour générer les URLs du sitemap
        $pageModel = Page::getInstance(); 
        $pages = $pageModel->getAllPages();

        foreach ($pages as $page) {
            // Récupérer l'URL de la page et la date de dernière modification
            $url = $page->getSlug(); // Récupére l'URL de la page
            $lastModified = $page->getLast_modified(); // Récupére la date de la dernières modifications des pages 

            // Ajouter la balise <url> avec l'URL et la date de dernière modification
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $lastModified . '</lastmod>';
            echo '</url>';
        }

        echo '</urlset>';
        }

}

?>