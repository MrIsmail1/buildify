<?php 

namespace App\Controllers;

// Importation des classes nécessaires
Use App\Core\View;
Use App\Models\User;
use App\Forms\UserConfig;
use App\Forms\EditUserConfig;
use App\Core\Verificator;
use App\DataTable\UsersTableConfig;
use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';


class UsersController {

    public function ViewUsers() {
        // Création d'une instance de la classe View pour afficher la vue des utilisateurs
        $view = new View("Users/users", 'back');

        // Configuration du filtre pour récupérer uniquement les utilisateurs confirmés
        $filter = ['confirmation' => true];
        
        // Récupération des utilisateurs depuis le modèle User (commenté pour le moment)
        $userModel = User::getInstance();
        $users = $userModel->read($filter);
        
        // Création d'une instance de UsersTableConfig pour la configuration du tableau de données
        $dataTable = new UsersTableConfig($users);
        
        // Assignation de la configuration du tableau de données à la vue
        $view->assign('dataTable', $dataTable->getConfig());
    }

    public function AddUser()
    {
        
        $form = new UserConfig();
        $view = new View("Users/singleUsers", "back");
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
                $role = $_POST['role'];

                // Check if email is already registered
                $exist = $userModel->getUserByEmail($email);
                if (empty($exist)) {

                    // Create new user
                    $userModel->setEmail($email);
                    $userModel->setPassword($password);
                    $userModel->setFirstname($firstname);
                    $userModel->setLastname($lastname);
                    $userModel->setRole($role);
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
                    $mail->Body = 'Lien de vérification de compte : http://localhost:8080/bdfy-admin/verif?token='.$token ; // Corps de l'e-mail

                    // Envoyer l'e-mail
                    if ($mail->send()) {
                        header('Location: /bdfy-admin/users');
                    } else {
                        $view->assign('errors', ['Echec d\'envoie d\'email !']);
                        http_response_code(404);
                    }
                    
                } else {
                    $view->assign('errors', ['L\'utilisateur existe déjà !']);
                }
            } else {
                $view->assign('errors', $errors);
            }
        }
    }

    public function DeleteUser()
    {
        $id = $_REQUEST['id'];
        $userModel = User::getInstance();
        $userModel->deleteUserById($id);
        header('Location:/bdfy-admin/users');
    }

    public function EditUser()
    {
        // Récupération de l'ID de l'utilisateur à modifier depuis la requête
        $id = $_REQUEST['id'];

        // Obtention de l'instance du modèle User
        $userModel = User::getInstance();

        // Récupération des informations de l'utilisateur à partir de son ID
        $user = $userModel->getUserById($id);

        // Création d'une instance de la classe View pour afficher la page de modification de l'utilisateur
        $view = new View("Users/singleUsers", 'back');

        // Création d'une instance de la classe EditUserConfig pour obtenir la configuration du formulaire de modification de l'utilisateur
        $form = new EditUserConfig($user);

        // Assignation de la configuration du formulaire à la vue
        $view->assign('form', $form->getConfig());

        // Vérification si le formulaire a été soumis
        if ($form->isSubmit()) {
            // Validation du formulaire en utilisant la classe Verificator et obtention des éventuelles erreurs
            $errors = Verificator::form($form->getConfig(), $_POST);

            // Vérification si aucune erreur n'est présente dans le formulaire
            if (empty($errors)) {
                // Traitement à effectuer lorsque le formulaire est soumis et valide
                $email = $_POST['email'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $role = $_POST['role'];
                // Vous pouvez ajouter votre logique de mise à jour des informations de l'utilisateur ici
                $userModel->updateEmail($email,$id);
                $userModel->updateFirstname($firstname,$id);
                $userModel->updateLastname($lastname,$id);
                $userModel->updateRole($role,$id);
                header('Location: /bdfy-admin/logout');
        }
    }
}

}