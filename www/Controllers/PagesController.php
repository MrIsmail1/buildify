<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Models\Page;
use App\DataTable\PagesTableConfig;
use App\Forms\PageConfig;
use App\Forms\EditPageConfig;

class PagesController
{
    public function ViewPages()
    {

        $view = new View("Pages/pages", 'back');
        $pageModel = Page::getInstance();
        $pages = $pageModel->getAllPages();
        var_dump($pages);
        $dataTable = new PagesTableConfig($pages);
        $view->assign('dataTable', $dataTable->getConfig());
    }
    public function AddPage()
    {
        $view = new View("Pages/singlePage", 'back');
        $form = new PageConfig();
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $pageModel = Page::getInstance();
                $pageModel->setPageTitle($_POST['titre']);
                $pageModel->setContent($_POST['content']);
                $pageModel->setSlug($_POST['slug']);
                $pageModel->setUserId($_SESSION["user"]["id"]);
                $pageModel->setPageAuthor($_SESSION["user"]["firstname"]);
                $pageModel->create();
            }
        }
    }
    public function DeletePage()
    {
        $id = $_REQUEST['id'];
        $pageModel = Page::getInstance();
        $pageModel->deletePageById($id);
        header('Location:/pages');
    }
    public function EditPage()
    {
        $id = $_REQUEST['id'];
        $pageModel = Page::getInstance();
        $page = $pageModel->getPageById($id);
        var_dump($page);
        $view = new View("Pages/singlePage", 'back');
        $form = new EditPageConfig($page);
        $view->assign('form', $form->getConfig());


        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
            }
        }
    }
}
