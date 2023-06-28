<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class PageConfig extends FormAbs
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
                "class" => "space-y-6",
            ],
            "labels" => [
                "titre" => [
                    "for" => "titre",
                    "text" => "Titre de la page :",
                ],
                "slug" => [
                    "for" => "slug",
                    "text" => "Le slug de la page :",
                ],
                "content" => [
                    "for" => "content",
                    "text" => "Le contenu de la page :",
                ],
            ],
            "inputs" => [
                "titre" => [
                    "type" => "text",
                    "placeholder" => "Titre...",
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "Slug...",
                ],
                "content" => [
                    "type" => "textarea",
                    "placeholder" => "Contenu...",
                ],
            ],
        ];
    }
}
