<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Models\Page;
use App\DataTable\PagesTableConfig;
use App\Forms\PageConfig;
use App\Forms\EditPageConfig;
use App\Forms\TemplateConfig;
use App\Models\Template;
use App\Renderer\RenderConfig;

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
                $pageModel->create();
                $id = $pageModel->getLastCreatedId();
                $templateModel = new Template();
                $templateModel->setPageId($id);
                $templateModel->create();
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
        $pageModel = Page::getInstance();
        $pageModel->deletePageById($id);
        header('Location:/pages');
    }

   public function EditPage()
{
    $id = $_REQUEST['id'];
    $pageModel = Page::getInstance();
    $page = $pageModel->getPageById($id);
    $view = new View("Pages/singlePage", 'back');
    $form = new EditPageConfig($page);
    $view->assign('form', $form->getConfig());

    if ($form->isSubmit()) {
        $errors = Verificator::form($form->getConfig(), $_POST);
        if (empty($errors)) {
            $pageModel = Page::getInstance();
            $pageModel->setPageTitle($_POST['titre']);
            $pageModel->setContent($_POST['content']);
            $pageModel->setSlug($_POST['slug']);

            // Update the SEO title and meta description
            $seoTitle = $_POST['seo_title'];
            $metaDescription = $_POST['meta_description'];

            // Update the page data
            $pageModel->setSeoTitle($seoTitle);
            $pageModel->setMetaDescription($metaDescription);

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

            // Assign the data to the view
            $view->assign('seoTitle', $pageModel->getSeoTitle());
            $view->assign('metaDescription', $pageModel->getMetaDescription());

            // Get the current page's HTML content
            ob_start();
            $view->renderSeo(); // Render the page's HTML
            $currentPageContent = ob_get_clean();

            // Update the page's HTML content with the updated SEO tags
            $updatedContent = $this->updatePageSeoTags($currentPageContent, $seoTitle, $metaDescription);

            // Output the updated content
            echo $updatedContent;
        } else {
            $view->assign('errors', $errors);
        }
    }
}
 

   private function updatePageSeoTags($currentPageContent, $seoTitle, $metaDescription)
    {
        // Update the <title> tag with the SEO title
        $updatedContent = preg_replace('/<title>(.*?)<\/title>/i', '<title>' . $seoTitle . '</title>', $currentPageContent);

        // Update the <meta name="description"> tag with the meta description
        $updatedContent = preg_replace('/<meta name="description" content="(.*?)">/i', '<meta name="description" content="' . $metaDescription . '">', $updatedContent);

        return $updatedContent;
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
                header("location: /pages/view?id={$id}");
            } else {
                $view->assign('errors', $errors);
            }
        }

        $pageModel = Page::getInstance();
        $page = $pageModel->getPageById($id);
        $render = new RenderConfig($page, $template);
        $view->assign('render', $render->getConfig());
    }

}
