<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class TemplateConfig extends FormAbs
{


    protected $method = "POST";
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
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
                "color" => [
                    "for" => "color",
                    "text" => "Choisir un couleur :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "font_family" => [
                    "for" => "font_family",
                    "text" => "Choisir la police :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "font_size" => [
                    "for" => "font_size",
                    "text" => "Choisir la taille de la police :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "color" => [
                    "type" => "select",
                    "placeholder" => "Selectionner une couleur",
                    "value" => $this->template[0]["color"],
                    "options" => [
                        "#FF0000" => "Red",
                        "#00FF00" => "Green",
                        "#0000FF" => "Blue",
                        "#FFFF00" => "Yellow",
                        "#000000" => "Default",
                    ],
                ],
                "font_family" => [
                    "type" => "select",
                    "placeholder" => "Select a role...",
                    "value" => $this->template[0]["font_family"],
                    "options" => [
                        "Arial, sans-serif" => "Arial",
                        "Helvetica, sans-serif" => "Helvetica",
                        "Times New Roman, serif" => "Times New Roman",
                        "Courier New, monospace" => "Courier New",
                        "Verdana, sans-serif" => "Verdana",
                    ],
                ],
                "font_size" => [
                    "type" => "select",
                    "placeholder" => "Select a role...",
                    "value" => $this->template[0]["font_size"],
                    "options" => [
                        "16" => "16px",
                        "18" => "18px",
                        "24" => "24px",
                        "32" => "32px",
                        "38" => "38px",
                    ],
                ],
            ]
        ];
    }
}
