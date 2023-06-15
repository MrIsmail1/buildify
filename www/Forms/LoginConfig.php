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
                "autocomplete" => "off",
                "action" => "",
                "enctype" => "",
                "submit" => "Se connecter",
                "class" => "space-y-6",
            ],
            "labels" => [
                "email" => [
                    "for" => "email",
                    "text" => "Adresse e-mail :",
                ],
                "password" => [
                    "for" => "password",
                    "text" => "Mot de passe :",
                ],
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email...",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe...",
                ],
            ],
            "resetPwd" => "/auth/reset_password",
        ];
    }
}
