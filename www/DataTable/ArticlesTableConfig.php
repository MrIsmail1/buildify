<?php

namespace App\DataTable;

use App\DataTable\Abstract\DataTableAbs;
use App\Models\Categorie;

class ArticlesTableConfig extends DataTableAbs
{
    private $articles;

    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    public function getConfig(): array
    {   
        return [
            "config" => [
                "class" => "table",
                "id" => "articlesTable",
            ],
            "headers" => [
                "articletitle" => "Titre",
                "articleauthor" => "Auteur",
                "categorie_title" => "Categorie",
                "last_modified" => "Date",
            ],
            "tbody" => [
                "articletitle" => "articletitle",
                "articleauthor" => "articleauthor",
                "categorie_title" => 'categorie_title',
                

                "last_modified" => "last_modified",
            ],
            "data" => $this->articles,
            "actions" => [
                "delete" => "/bdfy-admin/articles/delete?id=",
                "edit" => "/bdfy-admin/articles/edit?id=",
            ]
        ];
    }
}