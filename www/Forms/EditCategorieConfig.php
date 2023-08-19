<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class EditCategorieConfig extends FormAbs
{


    protected $method = "POST";
    private $categorie;

    public function __construct(array $categorie)
    {
        $this->categorie = $categorie;
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
                "title" => [
                    "for" => "title",
                    "text" => "Titre de la categorie :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "title...",
                    "value" => $this->categorie[0]["title"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
            ],
        ];
    }
}