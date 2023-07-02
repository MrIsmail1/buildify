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
                "autocomplete" => "on",
                "action" => "",
                "enctype" => "",
                "submit" => "Se connecter",
                "buttonClass" => "flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
                "class" => "space-y-6",
            ],
            "labels" => [
                "email" => [
                    "for" => "email",
                    "text" => "Adresse e-mail :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "password" => [
                    "for" => "password",
                    "text" => "Mot de passe :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email...",
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "error" => "E-mail ou mot de passe invalide"

                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe...",
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "error" => "E-mail ou mot de passe invalide"
                ],
            ],
            "resetPwd" => "/auth/reset_password",
        ];
    }
}
