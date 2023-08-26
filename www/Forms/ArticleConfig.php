<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class ArticleConfig extends FormAbs
{

    protected $method = "POST";
    private $categories;
    
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    

    public function getConfig(): array
    {

        $options = [];
    foreach ($this->categories as $category) {
        $options[$category['id']] = $category['title'];
    }
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
                "articletitle" => [
                    "for" => "articletitle",
                    "text" => "Titre de l'article :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "categorie_id" => [
                    "for" => "categorie_id",
                    "text" => "Categorie de l'article :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "content" => [
                    "for" => "content",
                    "text" => "Le contenu de l'article :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
            ],
            "inputs" => [
                "articletitle" => [
                    "type" => "text",
                    "placeholder" => "Titre...",
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                ],
                "categorie_id" => [
                "type" => "select",
                "placeholder" => "Select a categorie...",
                "options" => $options ,
                "value" => $this->categories[0] ,
            ],


                "content" => [
                    "type" => "textarea",
                    "id" => "content",
                    "rows" => "50",
                    "cols" => "125",
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                ],
                
            ],
        ];
    }
}