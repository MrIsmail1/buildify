<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class UserConfig extends FormAbs
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
                "submit" => "Enregistrer",
                "buttonClass" => "flex w-1/2 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
                "class" => "space-y-6",
            ],
            "labels" => [
                "firstname" => [
                    "for" => "firstname",
                    "text" => "Firstname :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "lastname" => [
                    "for" => "lastname",
                    "text" => "Lastname :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "email" => [
                    "for" => "email",
                    "text" => "Email :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "password" => [
                    "for" => "password",
                    "text" => "Password :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "role" => [
                "for" => "role",
                "text" => "Rôle :",
                "class" => "block text-sm font-medium leading-6 text-gray-900"
            ],


            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Firstname...",
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Lastname...",
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Email...",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Password...",
                ],
                "role" => [
                    "type" => "select",
                    "placeholder" => "Select a role...",
                    "options" => [
                        "admin" => "Admin",
                        "editor" => "Editor",
                    ],
                    "value" =>"admin",
                ],
            ],
        ];
    }
}
