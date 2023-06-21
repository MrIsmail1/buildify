<?php

namespace App\Controllers;

use App\Core\Db;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\LoginConfig;
use App\Models\User;

class AuthController
{

    public function login(): void
    {

        $form = new LoginConfig();
        $view = new View("Auth/login", "front");
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                /* $user = $userModel->getUserById($_POST['email']); */
                $userModel = User::getInstance();
                $user = $userModel->getUserById($_POST['id']);
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}
