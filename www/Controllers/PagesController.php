<?php

namespace App\Controllers;

use App\Models\PageMemento;
use App\Core\Verificator;
use App\Core\View;
use App\Models\Page;
use App\DataTable\PagesTableConfig;
use App\Forms\PageConfig;
use App\Forms\EditPageConfig;
use App\Forms\TemplateConfig;
use App\Models\Template;
use App\Models\Article;
use App\Renderer\MainConfig;
use App\Models\Categorie;

class PagesController
{
    public function ViewPages()
    {

        $view = new View("Pages/pages", 'back');
        $pageModel = Page::getInstance();
        $pages = $pageModel->getAllPages();
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
                $pageModel->setSlug($_POST['titre']);
                $pageModel->setUserId($_SESSION["user"]["id"]);
                $pageModel->setPageAuthor($_SESSION["user"]["firstname"]);
                $createdSlug = $pageModel->getSlug();
                $exist = $pageModel->findSlug($createdSlug);
                if (empty($exist)) {
                    $pageModel->create();
                    $id = $pageModel->getLastCreatedId();
                    $templateModel = new Template();
                    $templateModel->setPageId($id);
                    $templateModel->create();
                    header('Location:/bdfy-admin/pages');
                } else {
                    $view->assign('errors', ["Cette page existe déjà"]);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
    public function DeletePage()
    {
        $id = $_REQUEST['id'];
        $templateModel = new Template();
        $templateModel->deleteTemplateByPageId($id);
        $pageMementoModel = new PageMemento();
        $pageMementoModel->deletePageMementoByPageId($id);
        $pageModel = Page::getInstance();
        $pageModel->deletePageById($id);
        header('Location:/bdfy-admin/pages');
    }

    public function EditPage()
    {
        $id = $_REQUEST['id'];
        $pageModel = Page::getInstance();
        $page = $pageModel->getPageById($id);
        $view = new View("Pages/singlePage", 'back');
        $view->assign('id', $id);
        $form = new EditPageConfig($page);
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                // Create a memento before updating the page
                $mementoModel = new PageMemento();
                $mementoModel->setPageTitle($page[0]['pagetitle']);
                $mementoModel->setContent($page[0]['content']);
                $mementoModel->setSlug($page[0]['slug']);
                $mementoModel->setPageId($page[0]['id']);
                $mementoModel->setSaveDate(date("F j, Y, g:i a"));
                $mementoModel->create();
                $pageModel->setPageTitle($_POST['titre']);
                $pageModel->setContent($_POST['content']);
                $pageModel->setSlug($_POST['slug']);
                $pageModel->setSeoTitle($_POST['seo_title']);
                $pageModel->setMetaDescription($_POST['meta_description']);

                // Prepare the data for the update
                $data = [
                    'pagetitle' => $pageModel->getPageTitle(),
                    'content' => $pageModel->getContent(),
                    'slug' => $pageModel->getSlug(),
                    'seo_title' => $pageModel->getSeoTitle(),
                    'meta_description' => $pageModel->getMetaDescription()
                ];
                // Call the update function
                $pageModel->update($data, 'id', $id);
                header("location:/bdfy-admin/pages/edit?id={$id}");
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function ViewHistory()
    {
        $id = $_REQUEST['id'];
        $view = new View("Pages/history", "back");
        $mementoModel = PageMemento::getInstance();
        $history = $mementoModel->read(['page_id' => $id]);
        $view->assign('history', $history);
    }
    public function ApplyHistory()
    {
        $id = $_REQUEST['id'];
        $pageModel = Page::getInstance();
        $mementoModel = new PageMemento();
        $memento = $mementoModel->read(['id' => $id]);
        $page_id = $memento[0]["page_id"];
        $title = $memento[0]["pagetitle"];
        $content = $memento[0]["content"];
        $slug = $memento[0]["slug"];
        $pageModel->setPageTitle($title);
        $pageModel->setContent($content);
        $pageModel->setSlug($slug);

        $data = [
            'pagetitle' => $pageModel->getPageTitle(),
            'content' => $pageModel->getContent(),
            'slug' => $pageModel->getSlug(),
        ];
        $pageModel->update($data, 'id', $page_id);
        header("location:/bdfy-admin/pages");
    }

    public function ViewPage()
    {
        $id = $_REQUEST['id'];
        $view = new View('Pages/page', 'back');
        /* front edit */
        $templateModel = new Template();
        $template = $templateModel->getTemplatePageById($id);
        $form = new TemplateConfig($template);
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $templateModel->setColor($_POST['color']);
                $templateModel->setFontFamily($_POST['font_family']);
                $templateModel->setFontSize($_POST['font_size']);

                // Prepare the data for the update
                $data = [
                    'color' => $templateModel->getColor(),
                    'font_family' => $templateModel->getFontFamily(),
                    'font_size' => $templateModel->getFontSize(),
                ];

                // Call the update function
                $templateModel->update($data, 'id', $template[0]["id"]);
                header("location: /bdfy-admin/pages/view?id={$id}");
            } else {
                $view->assign('errors', $errors);
            }
        }
        $pageModel = Page::getInstance();
        $page = $pageModel->getPageById($id);
        $main = new MainConfig($page, $template, null, null);
        $view->assign('main', $main->getConfig());
    }
}
