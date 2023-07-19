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
                "submit" => "S'inscrire",
                "cancel" => "Annuler",
                "buttonClass" => "flex w-1/2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
                "class" => "space-y-6",
            ],
            "labels" => [
                "firstname" => [
                    "for" => "firstname",
                    "text" => "Prénom :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "lastname" => [
                    "for" => "lastname",
                    "text" => "Nom :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
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
                "passwordConfirm" => [
                    "for" => "passwordConfirm",
                    "text" => "Confirmation mot de passe :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Entrez votre prénom...",
                    "required" => true,
                    "min" => 2,
                    "max" => 25,
                    "error" => " Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Entrez votre nom...",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "error" => " Votre nom doit faire entre 2 et 100 caractères",
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email...",
                    "required" => true,
                    "error" => "Le format de votre email est incorrect"
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe...",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au min 8 caratères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation de mot de passe...",
                    "required" => true,
                    "error" => "Votre confirmation de mot de passe ne correspond pas",
                ]
            ]
        ];
    }
}
