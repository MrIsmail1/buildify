<?php

namespace App\Renderer;

use App\Renderer\Abstract\RenderAbs;

class MainConfig extends RenderAbs
{
    private $page;
    private $template;
    private $allArticles;
    private $categorie;

    public function __construct($page, $template, $allArticles, $categorie)
    {
        $this->page = $page;
        $this->template = $template;
        $this->allArticles = $allArticles;
        $this->categorie = $categorie;
    }

    public function getConfig(): array
    {
        return [
            

            "config" => [
                "id" => "main",
                "class" => "text-xl",
            ],
            "title" => [
                "id" => "title",
                "class" => "text-[" . $this->template[0]["color"] . "] text-[" . $this->template[0]["font_size"] . "px] font-[" . $this->template[0]["font_family"] . "]",
                "text" => $this->page[0]["pagetitle"],
            ],
            "content" => [
                "id" => "",
                "class" => "text-[" . $this->template[0]["color"] . "] text-[" . $this->template[0]["font_size"] . "px] font-[" . $this->template[0]["font_family"] . "]",
                "text" => $this->page[0]["content"],
            ],
            "articles" => $this->allArticles, // Ajout de la liste des articles
            "categorie" => $this->categorie,
        ];
    }
}


