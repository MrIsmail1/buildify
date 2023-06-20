<?php

namespace App\Controllers;

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

            //Recupère les infos dans le form
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

                    $mail = new PHPMailer;

                    // Configuration du serveur SMTP
                    $mail->isSMTP();
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                    $mail->Port = 465; // Port SMTP (utilisez 465 pour SSL)
                    $mail->SMTPAuth = true; // Activer l'authentification SMTP
                    $mail->Username = 'hamzamahmood93150@gmail.com'; // Votre adresse e-mail
                    $mail->Password = 'tmaakvgtnmffcylp'; // Votre mot de passe e-mail

                    // Configuration de l'e-mail
                    $mail->setFrom('hamzamahmood93150@gmail.com', 'Hamza Mahmood'); // Votre adresse e-mail et votre nom
                    $mail->addAddress('hamza.mahmood@outlook.fr', 'Tetst'); // Adresse e-mail et nom du destinataire
                    $mail->Subject = 'Test Email'; // Objet de l'e-mail
                    $mail->Body = 'This is a test email.'; // Corps de l'e-mail

                    // Envoyer l'e-mail
                    if ($mail->send()) {
                        echo 'E-mail sent successfully';
                    } else {
                        echo 'Error sending e-mail: ' . $mail->ErrorInfo;
                    }

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
