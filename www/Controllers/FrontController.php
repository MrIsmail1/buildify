<?php

namespace App\Controllers;

use App\Core\InstallerCore;
use App\Core\View;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Template;
use App\Renderer\MainConfig;
use App\Renderer\MenuConfig;
use App\Models\Article;
use App\Models\Categorie;

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
            exit;
        };

        $templateModel = new Template();
        $template = $templateModel->getTemplatePage($page[0]["id"]);

        $articleModel = new Article();
        $allarticle = $articleModel->getAllArticles();

        $categorieModel = new Categorie();
        $categorie = $categorieModel->getAllCategories();

        $main = new MainConfig($page, $template, $allarticle, $categorie);
        $menu = new MenuConfig($activeMenu);

        $view->assign('main', $main->getConfig());
        $view->assign('menu', $menu->getConfig());
        $view->assign("page", $page);


        // Gérer la partie SEO
        $seoTitle = $page[0]["seo_title"];
        $metaDescription = $page[0]["meta_description"];

        ob_start(); // Démarrer la capture de la sortie

        echo "<head>";
        echo "<title>" . htmlentities($seoTitle) . "</title>";
        echo "<meta name='description' content='" . htmlentities($metaDescription) . "'>";
        echo "</head>";
        $html = ob_get_clean(); // Récupérer la sortie capturée

        $view->assign('html', $html);
    }
    public function home()
    {
        $pageModel = Page::getInstance();
        $homeExists = $pageModel->read(["slug" => "home"]);
        $isInstalled = InstallerCore::checkInstalled();
        if (!count($homeExists)) {
            $view = new View("Front/home", "front");
            $view->assign("isInstalled", $isInstalled);
        } else {
            $menuModel = new Menu;
            $activeMenu = $menuModel->getActiveMenu();
            $menu = new MenuConfig($activeMenu);
            $view = new View("Front/index", "front");
            $view->assign("page", $homeExists);
            $templateModel = new Template();
            $template = $templateModel->getTemplatePage($homeExists[0]["id"]);
            $articleModel = new Article();
            $allarticle = $articleModel->getAllArticles();

            $categorieModel = new Categorie();
            $categorie = $categorieModel->getAllCategories();

            $main = new MainConfig($homeExists, $template, $allarticle, $categorie);
            $menu = new MenuConfig($activeMenu);

            $view->assign('main', $main->getConfig());
            $view->assign('menu', $menu->getConfig());
            $seoTitle = $homeExists[0]["seo_title"];
            $metaDescription = $homeExists[0]["meta_description"];

            ob_start(); // Démarrer la capture de la sortie

            echo "<head>";
            echo "<title>" . htmlentities($seoTitle) . "</title>";
            echo "<meta name='description' content='" . htmlentities($metaDescription) . "'>";
            echo "</head>";
            $html = ob_get_clean(); // Récupérer la sortie capturée

            $view->assign('html', $html);
        }
    }
}
