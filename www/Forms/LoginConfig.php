<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class LoginConfig extends FormAbs
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "action" => "",
                "enctype" => "",
                "submit" => "Se connecter",
                "cancel" => "Annuler"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email",
                    "error" => "Le format de votre email est incorrect"
                ],
                "pwd" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "error" => "Votre mot de passe est incorrect"
                ],
            ]
        ];
    }
}
