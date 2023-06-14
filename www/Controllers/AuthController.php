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
            
            // Check if email is already registered
            /* $existingUser = $userModel->getByEmail($email); */
            $existingUser=NULL;
            
            if ($existingUser==NULL) {
                // Create new user
                $user = [
                    'id' => 0,
                    'email' => $email,
                    'motdepasse' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'firstname' => 'Hamza',
                    'lastname' => 'Mahmood'
                ];
                /* var_dump($user); */

                $userId = $userModel->create($user);
                var_dump($userId);
                if ($userId) {
                    // Send verification email to user
                    
                    // Redirect to success page or display success message
                    header('Location: /register-success.php');
                    exit;
                } else {
                    $view->assign('errors', ['Failed to create user']);
                }
            } else {
                $view->assign('errors', ['Email or username already registered']);
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