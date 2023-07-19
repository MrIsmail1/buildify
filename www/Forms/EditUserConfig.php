<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class EditUserConfig extends FormAbs
{


    protected $method = "POST";
    private $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

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
                    "text" => "Prénom de l'utilisateur :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "lastname" => [
                    "for" => "lastname",
                    "text" => "Nom de l'utilisateur :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "email" => [
                    "for" => "email",
                    "text" => "Email de l'utilisateur :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "role" => [
                    "for" => "role",
                    "text" => "Rôle de l'utilisateur :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                    
                ],
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Firstname...",
                    "value" => $this->user[0]["firstname"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Lastname...",
                    "value" => $this->user[0]["lastname"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "email" => [
                    "type" => "email",
                    "placeholder" => "Email...",
                    "value" => $this->user[0]["email"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "role" => [
                "type" => "select",
                "placeholder" => "Select a role...",
                "options" => [
                    "admin" => "Admin",
                    "editor" => "Editor",
                ],
                "value" => $this->user[0]["role"],
                "class" => ""
                ],

                
            ],
        ];
    }
}