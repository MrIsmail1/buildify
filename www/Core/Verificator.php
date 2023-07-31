<?php

namespace App\Core;

class Verificator
{
    public static function form(array $config, array $data): array
    {
        $errors = [];
        $checkboxesChecked = false;
        $hasCheckboxes = false;

        foreach ($data as $inputName => $value) {
            $data[$inputName] = htmlspecialchars($value);
            if (!array_key_exists($inputName, $config['inputs']) && $inputName !== 'submit') {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Données de formulaire invalides']);
                exit();
            }
        }

        foreach ($config["inputs"] as $name => $configInput) {
            if ($configInput['type'] === 'checkbox') {
                $hasCheckboxes = true;
                if (isset($data[$name])) {
                    $checkboxesChecked = true;
                }
                continue;
            }

            if (!isset($data[$name])) {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Données de formulaire invalides']);
                exit();
            }
            if (isset($configInput["required"]) && self::isEmpty($data[$name])) {
                $errors[] = $name . " est un champ requis";
            }
            if (isset($configInput["min"]) && !self::isMinLength($data[$name], $configInput["min"])) {
                $errors[] = $name . " est plus court que la longueur minimale " . $configInput["min"];
            }
            if (isset($configInput["max"]) && !self::isMaxLength($data[$name], $configInput["max"])) {
                $errors[] = $name . " est plus long que la longueur maximale " . $configInput["max"];
            }
            if ($configInput["type"] == "email" && !self::checkEmail($data[$name])) {
                $errors[] = "Format de l'email invalide";
            }
            if ($configInput["type"] == "password" &&  !self::checkPwd($data[$name]) && empty($configInput["passwordConfirm"])) {
                $errors[] = "Le mot de passe doit comporter au moins 8 caractères et contenir au moins un chiffre et une lettre majuscule";
            }
        }

        if ($hasCheckboxes && !$checkboxesChecked) {
            $errors[] = "Au moins une case à cocher doit être sélectionnée";
        }

        return $errors;
    }

    public static function isEmpty(String $string): bool
    {
        return empty(trim($string));
    }
    public static function isMinLength(String $string, $length): bool
    {
        return strlen(trim($string)) >= $length;
    }
    public static function isMaxLength(String $string, $length): bool
    {
        return strlen(trim($string)) <= $length;
    }
    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public static function checkPwd($pwd): bool
    {
        return strlen($pwd) >= 8
            && preg_match("/[0-9]/", $pwd, $result)
            && preg_match("/[A-Z]/", $pwd, $result);
    }
}
