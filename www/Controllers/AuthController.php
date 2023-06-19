<?php

namespace App\Controllers;

use App\Core\Db;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\LoginConfig;
use App\Forms\RegisterConfig;
use App\Models\User;


class AuthController
{
    public function register(): void
    {
        $form = new RegisterConfig();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $errors = Verificator::form($form->getConfig(), $_POST);

            if (empty($errors)) {
                $userModel = User::getInstance();
                $email = $_POST['email'];
                $password = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];

                // Check if email is already registered

                $exist = $userModel->getUserByEmail($email);
                if (empty($exist)) {
                    // Create new user
                    $userModel->setEmail($email);
                    $userModel->setPassword($password);
                    $userModel->setFirstname($firstname);
                    $userModel->setLastname($lastname);
                    $userModel->create();
                    // Send verification email to user

                    //Redirect to success page or display success message
                    //     header('Location: /register-success.php');
                } else {
                    $view->assign('errors', ['L\'utilisateur existe déjà !']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }




    public function login(): void
    {
        // Check if user is already logged in
        if (isset($_COOKIE['token'])) {
            header('Location: /dashboard.php');
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
                $users = $userModel->read(null);
                $user = null;
                foreach ($users as $u) {
                    if ($u['email'] === $email) {
                        $user = $u;
                        break;
                    }
                }
                var_dump($user);
                if ($user !== null && ($_POST['password'] === $user['password'])) {
                    $token = $userModel->generateToken();
                    $userModel->update(['token' => $token], "iduser", $user['iduser']);
                    setcookie('token', $token, time() + 3600, '/');
                    header('Location: /dashboard.php');
                    exit;
                } else {
                    $view->assign('errors', ['Invalid email or password']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}
