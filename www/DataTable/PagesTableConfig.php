<?php

namespace App\DataTable;

use App\DataTable\Abstract\DataTableAbs;

class PagesTableConfig extends DataTableAbs
{
    private $pages;

    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }
    public function getConfig(): array
    {

        return [
            "config" => [
                "class" => "table",
                "id" => "pagesTable",
            ],
            "headers" => [
                "pagetitle" => "Titre",
                "pageauthor" => "Auteur",
                "last_modified" => "Date",
            ],
            "tbody" => [
                "pagetitle" => "pagetitle",
                "pageauthor" => "pageauthor",
                "last_modified" => "last_modified",
            ],
            "data" => $this->pages,
            "actions" => [
                "view" => "/bdfy-admin/pages/view?id=",
                "delete" => "/bdfy-admin/pages/delete?id=",
                "edit" => "/bdfy-admin/pages/edit?id=",
            ]
        ];
    }
}
