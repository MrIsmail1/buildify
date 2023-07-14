<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\LoginConfig;
use App\Forms\RegisterConfig;
use App\Models\User;

require_once 'vendor/autoload.php';

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

                    // Créer un token de connexion pour l'utilisateur 
                    $token = $userModel->generateToken();
                    $userModel->setToken($token);

                    // Insérer l'utilisateur dans la base de données
                    $userModel->create();

                    // Send verification email to user
                    $mail = new PHPMailer;

                    // Configuration du serveur SMTP
                    $mail->isSMTP();
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'hamzamahmood93150@gmail.com'; // Votre adresse e-mail
                    $mail->Password = getenv('VERIF_MAIL'); // Votre mot de passe e-mail

                    // Configuration de l'e-mail
                    $mail->setFrom('hamzamahmood93150@gmail.com', 'Hamza Mahmood'); // Votre adresse e-mail et votre nom
                    $mail->addAddress($email, 'Test'); // Adresse e-mail et nom du destinataire
                    $mail->Subject = 'Email de vérification buildify'; // Objet de l'e-mail
                    $mail->Body = 'Lien de vérification de compte : http://localhost:8080/verif?token='.$token ; // Corps de l'e-mail

                    // Envoyer l'e-mail
                    if ($mail->send()) {
                        header('Location: /login');
                        echo 'E-mail sent successfully';
                    } else {
                        $view->assign('errors', ['Echec d\'envoie d\'email !']);
                        http_response_code(404);
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
                    //fonction password verify a faire ici 
                    $token = $userModel->generateToken();
                    $userModel->update(['token' => $token], "id", $user['id']);
                    setcookie('token', $token, time() + 3600, '/');
                    header('Location: /dashboard');
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
