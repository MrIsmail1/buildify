<?php

namespace App\Core;

use App\Models\User;
use PDO;

class InstallerCore
{
    public static function checkDbConnection($credentials)
    {
        try {
            $pdo = new PDO(
                "pgsql:host={$credentials['host']};dbname={$credentials['dbname']};port=5432",
                $credentials['username'],
                $credentials['password']
            );
            // Set PDO attributes if needed
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // If connection is established successfully, return true
            return true;
        } catch (\PDOException $e) {
            // If connection fails, catch the exception and return false
            return false;
        }
    }

    public static function createAdminUser($userInfo)
    {
        $userModel = new User();
        $userModel->setEmail($userInfo['email']);
        $userModel->setPassword($userInfo['password']);
        $userModel->setFirstname($userInfo['firstname']);
        $userModel->setLastname($userInfo['lastname']);
        $userModel->setConfirmation(true);
        $userModel->setRole("Admin");
        $token = $userModel->generateToken();
        $userModel->setToken($token);
        $userModel->create();
    }

    public static function setInstalledFlag($installed = false, $credentials)
    {
        // Load the existing config
        $config = require 'Config.php';

        // Update the 'installed' flag
        $config['installed'] = $installed;
        $config['dbHost'] =  $credentials['host'];
        $config['dbName'] =  $credentials['dbname'];
        $config['dbUsername'] =  $credentials['username'];
        $config['dbPassword'] =  $credentials['password'];

        // Write the updated config back to the file
        file_put_contents('Config.php', "<?php\n\nreturn " . var_export($config, true) . ";\n");
    }

    public static function checkInstalled()
    {
        $config = require 'Config.php';
        return $config['installed'] ?? false;
    }

    public static function initDbWithFakeData()
    {
        $query = file_get_contents('script.sql');
        $db = Db::getInstance();
        $db->createDatabase($query);
    }
}
