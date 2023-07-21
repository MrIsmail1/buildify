<?php
namespace App\Controllers;

use App\Core\View;

class SettingsController
{
    public function Settings()
    {
        $view = new View("Settings/settings", "back");
        $view->assign('form', $form->getConfig());
    }
}