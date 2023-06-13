<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class RegisterConfig extends FormAbs
{

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "autocomplete" => "off",
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
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe",
                    "error" => "Votre mot de passe est incorrect"
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation de mot de passe",
                    "error" => "Votre mot de passe de confirmation est incorrect"
                ]
            ]
        ];
    }
}
