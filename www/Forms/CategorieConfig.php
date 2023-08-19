<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class CategorieConfig extends FormAbs
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
                "title" => [
                "for" => "title",
                "text" => "Titre de la catégorie :",
                "class" => "block text-sm font-medium leading-6 text-gray-900"
            ],

            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Titre...",
                ],
            ],
        ];
    }
}
