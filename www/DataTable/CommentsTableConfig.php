<?php

namespace App\DataTable;

use App\DataTable\Abstract\DataTableAbs;

class CommentsTableConfig extends DataTableAbs
{
    private $comments;

    public function __construct(array $comments)
    {
        $this->comments = $comments;
    }
    public function getConfig(): array
    {

        return [
            "config" => [
                "class" => "table",
                "id" => "commentsTable",
            ],
            "headers" => [
                "user_id" => "ID utilisateur",
                "page_id" => "ID page",
                "content" => "Contenu",
                "date_creation_publication" => "Date de création",
            ],
            "tbody" => [
                "user_id" => "user_id",
                "page_id" => "page_id",
                "content" => "content",
                "date_creation_publication" => "date_creation_publication",
            ],
            "data" => $this->comments,
            "actions" => [
                "delete" => "/comments/delete?id=",
                "edit" => "/comments/edit?id=",
            ]
        ];
        
    }
}
