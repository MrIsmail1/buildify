<?php

namespace App\Core;

class Verificator
{
    public static function form(array $config, array $data): array
    {
        $errors = [];
        $checkboxesChecked = false;
        $hasCheckboxes = false;

        //Le nb de inputs
        foreach ($data as $inputName => $value) {
            if (!array_key_exists($inputName, $config['inputs']) && $inputName !== 'submit') {
                http_response_code(404);
                die("Tentative de Hack");
            }
        }


        foreach ($config["inputs"] as $name => $configInput) {
            if ($configInput['type'] === 'checkbox') {
                $hasCheckboxes = true;
                if (isset($data[$name])) {
                    // at least one checkbox was checked
                    $checkboxesChecked = true;
                }
                continue;
            }

            if (!isset($data[$name])) {
                http_response_code(404);
                die("Tentative de Hack");
            }
            if (isset($configInput["required"]) && self::isEmpty($data[$name])) {
                $errors[] = $name . " est un champs obligatoire";
            }
            if (isset($configInput["min"]) && !self::isMinLength($data[$name], $configInput["min"])) {
                $errors[] = $configInput["error"];
            }
            if (isset($configInput["max"]) && !self::isMaxLength($data[$name], $configInput["max"])) {
                $errors[] = $configInput["error"];
            }
            if ($configInput["type"] == "email" && !self::checkEmail($data[$name])) {
                $errors[] = $configInput["error"];
            }
            if ($configInput["type"] == "password" &&  !self::checkPwd($data[$name]) && empty($configInput["passwordConfirm"])) {
                $errors[] = $configInput["error"];
            }
        }

        if ($hasCheckboxes && !$checkboxesChecked) {
            $errors[] = "Vous devez selectionner au moins un élement";
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
