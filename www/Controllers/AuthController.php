<?php

namespace App\Controllers;


use App\Core\Verificator;
use App\Core\View;
use App\Forms\LoginConfig;
use App\Models\User;

class AuthController
{

    public function login(): void
    {
        // Check if user is already logged in
        if (isset($_COOKIE['token'])) {
            header('Location: /dashboard');
            exit;
        }

        $form = new LoginConfig();
        $view = new View("Auth/login", "front");
        $view->assign('form', $form->getConfig());
        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($errors)) {
                $userModel = User::getInstance();
                $email = $_POST['email'];
                var_dump($email);
                $users = $userModel->read(null);
                $user = null;
                foreach ($users as $u) {
                    var_dump($u["email"]);
                    if (rtrim($u['email']) === $email) {
                        $user = $u;
                        break;
                    }
                }
                if ($user !== null && ($_POST['password'] === $user['password'])) {
                    $token = $userModel->generateToken();
                    $userModel->update(['token' => $token], "id", $user['id']);
                    setcookie('token', $token, time() + 3600, '/');
                    $_SESSION['user'] = $user;
                    header('Location: /dashboard');
                    exit;
                } else {
                    $view->assign('errors', ['E-mail ou mot de passe invalide']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}
