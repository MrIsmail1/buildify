<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class EditPageConfig extends FormAbs
{


    protected $method = "POST";
    private $page;

    public function __construct($page)
    {
        $this->page = $page;
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
                "titre" => [
                    "for" => "titre",
                    "text" => "Titre de la page :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "slug" => [
                    "for" => "slug",
                    "text" => "Le slug de la page :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "content" => [
                    "for" => "content",
                    "text" => "Le contenu de la page :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ]
            ],
            "inputs" => [
                "titre" => [
                    "type" => "text",
                    "placeholder" => "Titre...",
                    "value" => $this->page[0]["pagetitle"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "Slug...",
                    "value" => $this->page[0]['slug'],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
                "content" => [
                    "id" => "content",
                    "type" => "textarea",
                    "rows" => "50",
                    "cols" => "125",
                    "value" => $this->page[0]["content"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                ],
            ],
        ];
    }
}
