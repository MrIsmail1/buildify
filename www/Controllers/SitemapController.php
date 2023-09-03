<?php

namespace App\Controllers;

use App\Models\Page;

class SitemapController
{
    public function ViewSitemap()
    {
        header("Content-type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $pageModel = Page::getInstance();
        $pages = $pageModel->getAllPages();
       foreach ($pages as $page) {
        $url = $page['slug'];
        $lastModified = $page['last_modified'];

        // Vérifier si l'URL complète commence par "http://localhost:8080/bdfy-admin" et l'exclure
        if (strpos($url, 'http://localhost:8080/bdfy-admin') !== 0) {
            echo '<url>';
            echo '<loc>' . $url . '</loc>';
            echo '<lastmod>' . $lastModified . '</lastmod>';
            echo '</url>';
        }
    }


        echo '</urlset>';
        exit;
    }
}


?>