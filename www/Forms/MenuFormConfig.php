<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class MenuFormConfig extends FormAbs
{
    protected $method = "POST";
    protected $slugs = [];

    public function __construct(array $slugs)
    {
        $this->slugs = $slugs;
    }

    public function getConfig(): array
    {
        $config = [
            "config" => [
                "method" => $this->getMethod(),
                "autocomplete" => "on",
                "action" => "",
                "enctype" => "",
                "submit" => "Enregister",
                "buttonClass" => "flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
                "class" => "space-y-6",
            ],
            "labels" => [
                "name" => [
                    "for" => "name",
                    "text" => "Nom du menu :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "active" => [
                    "for" => "active",
                    "text" => "Menu actif :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Entrer le nom du menu",
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                    "value" => ""
                ],
                "active" => [
                    "type" => "checkbox",
                    "class" => "",
                    "value" => "1",
                    "checked" => false,
                ]
            ]
        ];
        foreach ($this->slugs as $slug) {
            $config['inputs'][$slug] = [
                "type" => "checkbox",
                "class" => "your-checkbox-class",
                "checked" => false,
                "value" => $slug,
            ];
            $config['labels'][$slug] = [
                "class" => "your-label-class",
                "text" => $slug
            ];
        }

        return $config;
    }
}
