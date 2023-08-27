<?php

namespace App\Controllers;

use App\Core\InstallerCore;

class InstallerController
{
    public function setup()
    {

        if (!empty($_POST)) {
            $credentials = [
                'host' => $_POST['host'],
                'dbname' => $_POST['dbname'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ];

            if (InstallerCore::checkDbConnection($credentials)) {
                InstallerCore::setInstalledFlag(true, $credentials);
                echo json_encode(['success' => true, 'message' => 'Les identifiants de la base de données sont valides']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Les identifiants de la base de données sont invalides']);
            }
        }
    }
    public function launchInstaller()
    {
        if (!empty($_POST) && InstallerCore::checkInstalled()) {
            // Validate user input
            $validationErrors = $this->validateUserInfo($_POST);

            if (empty($validationErrors)) {
                $userInfo = [
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email'],
                    "password" => $_POST['password'],
                ];
                if (!empty($_POST['fakeData']) && $_POST['fakeData'] === "on") {
                    InstallerCore::initDbWithFakeData();
                }
                InstallerCore::createAdminUser($userInfo);
                echo json_encode(['success' => true, 'message' => 'Le compte admin a été créé avec succès']);
            } else {
                echo json_encode(['error' => true, 'message' => 'Les données utilisateur sont invalides', 'errors' => $validationErrors]);
            }
        } else {
            echo json_encode(['error' => true, 'message' => 'Les identifiants de la base de données sont invalides']);
        }
    }

    private function validateUserInfo($userData)
    {
        $errors = [];

        // Validate firstname, lastname, email, password, etc.
        if (empty($userData['firstname'])) {
            $errors[] = 'Le prénom est requis.';
        }

        if (empty($userData['lastname'])) {
            $errors[] = 'Le nom de famille est requis.';
        }

        if (empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'adresse email est invalide.';
        }

        if (empty($userData['password']) || strlen($userData['password']) < 6) {
            $errors[] = 'Le mot de passe doit avoir au moins 6 caractères.';
        }
        if (empty($userData['passwordConfirm']) || ($userData['passwordConfirm'] !== $userData['password'])) {
            $errors[] = 'Votre confirmation de mot de passe ne correspond pas.';
        }

        return $errors;
    }
}
