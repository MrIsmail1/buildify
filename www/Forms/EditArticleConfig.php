<?php

namespace App\Forms;

use App\Forms\Abstract\FormAbs;

class EditArticleConfig extends FormAbs
{
    protected $method = "POST";
    private $article;
    private $categorie;

    public function __construct($article, $categorie)
    {
        $this->article = $article;
        $this->categorie = $categorie;
    }

    public function getConfig(): array
    {
        $options = [];
        foreach ($this->categorie as $category) {
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
                "slug" => [
                    "for" => "slug",
                    "text" => "Le slug de l'article :",
                    "class" => "block text-sm font-medium leading-6 text-gray-900"
                ],
                "categorie" => [
                    "for" => "categorie",
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
                    "value" => $this->article[0]["articletitle"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "Slug...",
                    "value" => $this->article[0]['slug'],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                ],
                "categorie" => [
                    "type" => "select",
                    "placeholder" => "Sélectionnez une catégorie...",
                    "options" => $options,
                    "value" => $this->article[0]["categorie_id"], // Utilisez le bon champ ici
                ],
                "content" => [
                    "id" => "content",
                    "type" => "textarea",
                    "rows" => "50",
                    "cols" => "125",
                    "value" => $this->article[0]["content"],
                    "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",
                    "required" => "true",
                ],
            ],
            "content" => [
                "label" => "Contenu de l'article...",
                "id" => "content",
                "rows" => "50",
                "cols" => "125",
                "value" => $this->article[0]["content"],
                "class" => "block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            ],
        ];
    }
}
