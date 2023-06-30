<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class CommentsConfig extends FormAbs
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
                "submit" => "Ajouter un commentaire",
                "class" => "space-y-6",
            ],
            "labels" => [
                "content" => [
                    "for" => "content",
                    "text" => "Contenu du commentaire :",
                ],
            ],
            "inputs" => [
                "content" => [
                    "type" => "textarea",
                    "placeholder" => "Votre commentaire...",
                ],
            ],
        ];
    }
}
