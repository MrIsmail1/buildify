<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class EditMenuFormConfig extends FormAbs
{
    protected $method = "POST";
    protected $slugs = [];
    protected $menu;

    public function __construct(array $slugs, $menu)
    {
        $this->slugs = $slugs;
        $this->menu = $menu;
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
                    "value" => $this->menu[0]["name"]
                ],
                "active" => [
                    "type" => "checkbox",
                    "class" => "",
                    "value" => $this->menu[0]["active"],
                    "checked" => $this->menu[0]["active"],
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

        if ($this->menu) {

            $itemsStr = trim($this->menu[0]['items'], '{}');
            $itemsArray = explode(',', $itemsStr);
            foreach ($itemsArray as $slug) {
                if (isset($config['inputs'][$slug])) {
                    $config['inputs'][$slug]['checked'] = true;
                }
            }
        }

        return $config;
    }
}
