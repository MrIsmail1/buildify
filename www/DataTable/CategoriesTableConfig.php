<?php

namespace App\DataTable;

use App\DataTable\Abstract\DataTableAbs;


class CategoriesTableConfig extends DataTableAbs
{
    private $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function getConfig(): array
    {

        return [
            "config" => [
                "class" => "categorieTable",
                "id" => "categorieTable",
            ],
            "headers" => [
                "title" => "Title",
            ],
            "tbody" => [
                "title" => "title",
            ],
            "data" => $this->categories,
            "actions" => [
                "delete" => "/bdfy-admin/categories/delete?id=",
                "edit" => "/bdfy-admin/categories/edit?id=",
            ]
        ];
    }
}
