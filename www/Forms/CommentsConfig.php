<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class CommentsConfig extends FormAbs
{
    protected $method="POST";
    private $comments;


    public function __construct($comments)
    {
        $this->comments = $comments;
    }


    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => $this->getMethod(),
                "autocomplete" => "off",
                "action" => "",
                "enctype" => "",
                "submit" => "Ajouter un commentaire",
                "buttonClass" => "flex justify-center items-center rounded-md bg-indigo-600 mx-auto mb-4 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
                "class" => "space-y-6 ",            
            ],
            "comments" => $this->comments,
            "labels" => [
                "author" => [
                    "for" => "author",
                    "text" => "",
                    "class" => "label_class",
                ],
                "content" => [
                    "for" => "content",
                    "text" => "",
                    "class" => "label_class",
                ],
            ],
            "inputs" => [
                "author" => [
                    "type" => "text",
                    "placeholder" => "Votre nom...",
                    "id" => "author",
                    "class" => "hidden ",
                    "value" => "",
                ],
                "content" => [
                    "type" => "text",
                    "placeholder" => "Votre commentaire...",
                    "id" => "comment",
                    "rows" => "4",
                    "cols" => "50",
                    "class" => "block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm",
                    "value" => "",
                ],
            ],
        ];
    }
}