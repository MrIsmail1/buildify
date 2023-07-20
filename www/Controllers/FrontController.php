<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Template;
use App\Models\Comments;
use App\Renderer\MainConfig;
use App\Renderer\MenuConfig;
use App\Forms\CommentsConfig;



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
        }
     

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentAuthor = $_POST['author'];
            $content = $_POST['content'];
            
            if ($commentAuthor && $content) {
                $comment = new Comments();
                $comment->setContent($content);
                $comment->setCommentAuthor($commentAuthor);
                $comment->setIdPage($page[0]["id"]);
                $comment->setReported(false);
                $comment->create();
            }
        }
        
        //récupérer les comments de la page
        
        var_dump($page[0]["id"]);
        $commentsModel = new Comments();
        $comments = isset($page[0]["id"]) ? $commentsModel->getCommentsForPage($page[0]["id"]) : [];

        $form = new CommentsConfig();
        $formConfig = $form->getConfig();
        $formConfig['config']['action'] = '/bdfy-admin/comments/add/' . $page[0]['id'];
        
        $view->assign('commentForm', $formConfig);

        

        //config pour la datatable des comments
        //$dataTable = new CommentsTableConfig($comments);
        //assigner à la vue
        $view->assign("page" , $page);
        $view->assign("comments", $comments);



        //$menuModel = new Menu();
        //$menu = $menuModel->getActiveMenu();

        $templateModel = new Template();
        $template = $templateModel->getTemplatePage($page[0]["id"]);
        
        $main = new MainConfig($page, $template);
        $menu = new MenuConfig($activeMenu);

        $view->assign('main', $main->getConfig());
        $view->assign('menu', $menu->getConfig());
    }

    public function displayPage($slug)
    {
        $PageModel = Page::getInstance();
        $page = $PageModel->getPageBySlug($slug);

        $CommentsModel = Comments::getInstance();
        $comments = $CommentsModel->getCommentsByPageId($page->getId());

        $view = new View("Page/view", "front");
        $view->assign("page", $page);
        $view->assign("comments", $comments);

        $form = new CommentsConfig();
        $view->assign('form', $form->getConfig());
    
        
}

}
