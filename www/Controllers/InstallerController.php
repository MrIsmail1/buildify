<?php

namespace App\Controllers;

use App\Core\InstallerCore;

class InstallerController
{
    public function setup()
    {
        if (!empty($_POST)) {
            if ($_POST['step'] === "1") {
                $credentials = [
                    'host' => $_POST['host'],
                    'dbname' => $_POST['dbname'],
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                ];

                if (InstallerCore::checkDbConnection($credentials)) {
                    echo json_encode(['success' => true, 'message' => 'Database credentials are valid']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Database credentials are invalid']);
                }
            } else if ($_POST['step'] === "2") {
                $userInfo = [
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email'],
                    "password" => $_POST['password'],
                ];
                InstallerCore::createAdminUser($userInfo);
                echo json_encode(['success' => true, 'message' => 'Compte admin créer avec success']);
            }
        }
    }
}
