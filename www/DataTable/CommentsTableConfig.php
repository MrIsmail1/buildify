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
                "idpage" => "ID page",
                "content" => "Contenu",
                "date" => "Date de création",
            ],
            "tbody" => [
                "user_id" => "userid",
                "idpage" => "idpage",
                "content" => "content",
                "date" => "date",
            ],
            "data" => $this->comments,
            "actions" => [
                "delete" => "/comments/delete?id=",
                "edit" => "/comments/edit?id=",
                "comment" => "/comments/add?id=",
            ]
        ];
        
    }
}
