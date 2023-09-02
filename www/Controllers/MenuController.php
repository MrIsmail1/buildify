<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\EditMenuFormConfig;
use App\Forms\MenuFormConfig;
use App\Models\Menu;
use App\Models\Page;

class MenuController
{
    public function CreateMenu()
    {
        $view = new View("Menu/singlemenu", 'back');
        $pageModel = Page::getInstance();
        $pages = $pageModel->read();


        $slugs = [];
        foreach ($pages as $page) {
            array_push($slugs, $page['slug']);
        }
        $form = new MenuFormConfig($slugs); // $slugs is an array of page slugs
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $menuModel = new Menu();
                $menuModel->setName($_POST['name']);

                $exist = $menuModel->findMenuByName($menuModel->getName());
                if (empty($exist)) {
                    $items = [];
                    foreach ($slugs as $slug) {
                        if (isset($_POST[$slug]) && $_POST[$slug] === $slug) {
                            $items[] = $slug;
                        }
                    }
                    $items_pg_array = '{' . implode(",", $items) . '}';
                    $menuModel->setItems($items_pg_array);
                    if (isset($_POST["active"]) && $_POST["active"] === "on") {
                        $active = $menuModel->getActiveMenu();
                        if (count($active)) {
                            $menuModel->update($active, 'id', $active[0]["id"]);
                        }
                        $menuModel->setActive(true);
                    }
                    $menuModel->create();
                    header("location:/bdfy-admin/menus ");
                } else {
                    $view->assign('errors', ["Le nom du menu existe déjà"]);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
    public function EditMenu()
    {
        $view = new View("Menu/singlemenu", 'back');
        $id = $_REQUEST['id'];
        $pageModel = Page::getInstance();
        $pages = $pageModel->read();
        $slugs = [];
        foreach ($pages as $page) {
            array_push($slugs, $page['slug']);
        }
        $menuModel = new Menu();
        $menu = $menuModel->findMenuById($id);
        $form = new EditMenuFormConfig($slugs, $menu);
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $menuModel->setName($_POST['name']);
                $items = [];
                foreach ($slugs as $slug) {
                    if (isset($_POST[$slug]) && $_POST[$slug] === $slug) {
                        $items[] = $slug;
                    }
                }
                $items_pg_array = '{' . implode(",", $items) . '}';
                $menuModel->setItems($items_pg_array);
                if (isset($_POST["active"]) && $_POST["active"] === "on") {
                    $menuModel->setActive(true);
                } else {
                    $menuModel->setActive(false);
                }
                $data = [
                    'name' => $menuModel->getName(),
                    'items' => $menuModel->getItems(),
                    'active' => $menuModel->getActive(),
                ];
                header("location:/bdfy-admin/menus ");
                $menuModel->update($data, 'id', $menu[0]["id"]);
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function ViewMenus()
    {
        $view = new View("Menu/menus", 'back');
        $menuModel = Menu::getInstance();
        $menus = $menuModel->read();
        $view->assign('menus', $menus);
    }
    public function DeleteMenu()
    {
        $id = $_REQUEST['id'];
        $menuModel = Menu::getInstance();
        $menuModel->deleteMenuById($id);
        header('Location:/bdfy-admin/menus');
    }
}
