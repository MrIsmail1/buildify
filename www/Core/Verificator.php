<?php
namespace App\Core;

//Class qui vérifie ce qui lui est passé dans l'input
class Verificator
{

    public static function form(array $config, array $data): array
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $listOfErrors = [];
        // Vérifier si le nombre de champs dans la configuration correspond au nombre de champs dans les données
        if (count($config["inputs"]) != count($data) - 1) {
            die("Le nombre de champs dans la configuration correspond au nombre de champs dans les données");
        }

        // Parcourir chaque champ dans la configuration
        foreach ($config["inputs"] as $name => $input) {

            // Vérifier si le champ est vide
            if (empty($data[$name])) {
                die("Le champ est vide");
            }

            // Check if the password and the confirm password are the same 
            if ( $password !== $passwordConfirm ) {
                die("Password and Confirm Password are not the same");
            }

            // Check if the password have 8 characters with 1 number
            if (strlen($password) < 8 || !preg_match("/\d/", $password)) {
                die("Password need to have at least 8 characters with 1 number");
            }

            // Vérifier si le champ est de type "email" et si la valeur est un email valide
            if ($input["type"] == "email" && !self::checkEmail($data[$name])) {
                $listOfErrors[] = $input["error"];
            }

            // Check if in the firstname or lastname we have forbidden character
            if ( !preg_match("/^[a-zA-Z]+$/", $firstname) || !preg_match("/^[a-zA-Z]+$/", $lastname) ) {
                die("firstname or lastname have forbidden character");
            }
        }

        return $listOfErrors;
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /* public static function checkPassword () {

    } */
}
