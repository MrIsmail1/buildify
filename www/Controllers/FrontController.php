<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Template;
use App\Renderer\MainConfig;
use App\Renderer\MenuConfig;

class FrontController
{
    public function index()
    {
        $view = new View("Front/index", "front");
        $menuModel = Menu::getInstance();
        $activeMenu = $menuModel->getActiveMenu();
        $pageModel = new Page();
        $urlPath = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $page = $pageModel->findPageByUrl($urlPath);
        
        if (!isset($page)) {
            http_response_code(404);
            header("location: /404");
        }
        $menuModel = new Menu();
        $menu = $menuModel->getActiveMenu();
        $templateModel = new Template();
        $template = $templateModel->getTemplatePage($page[0]["id"]);
        $main = new MainConfig($page, $template);
        $menu = new MenuConfig($activeMenu);
        $view->assign('main', $main->getConfig());
        $view->assign('menu', $menu->getConfig());
        


        $seoTitle= $page[0]["seo_title"];
        $metaDescription= $page[0]["meta_description"]; 
        
        ob_start(); // Démarrer la capture de la sortie

        echo "<head>";
        echo "<title>" . htmlentities($seoTitle) . "</title>";
        echo "<meta name='description' content='" . htmlentities($metaDescription) . "'>";
        echo "</head>";
        $html = ob_get_clean(); // Récupérer la sortie capturée

        $view->assign('html', $html);

        
    }

}