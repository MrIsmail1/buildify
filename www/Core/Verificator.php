<?php

namespace App\Core;

class Verificator
{
    public static function form(array $config, array $data): array
    {
        $errors = [];

        //Le nb de inputs
        if (count($config["inputs"]) + 1 != count($data)) {
            die("Tentative de Hack");
            http_response_code(404);
        }

        foreach ($config["inputs"] as $name => $configInput) {
            if (!isset($data[$name])) {
                die("Tentative de Hack");
                http_response_code(404);
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
