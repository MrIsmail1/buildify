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
                "action" => $_SERVER['REQUEST_URI'],
                "enctype" => "",
                "submit" => "Ajouter un commentaire",
                "class" => "space-y-6",
            ],
            "labels" => [
                
                "author" => [
                    "for" => "author",
                    "text" => "Auteur du commentaire :",
                    "class" => "label_class",
                ],
                "content" => [
                    "for" => "content",
                    "text" => "Contenu du commentaire :",
                    "class" => "label_class",
                ],
            ],
            "inputs" => [
                    "author" => [
                    "type" => "text",
                    "placeholder" => "Votre nom...",
                    "id" => "author",
                    "class" => "",
                    "value" => "",
                ],
                "content" => [
                    "type" => "text",
                    "placeholder" => "Votre commentaire...",
                    "id" => "comment",
                    "rows" => "4",
                    "cols" => "50",
                    "class" => "",
                    "value" => "",
                ],
            ],
        ];
    }
}
