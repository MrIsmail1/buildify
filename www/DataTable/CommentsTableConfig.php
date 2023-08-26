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
                "CommentAuthor" => "Auteur",
                
                "content" => "Commentaire",
                "date" => "Date de création",
            ],
            "tbody" => [
                "comment_author" => "comment_author",
                
                "content" => "content",
                "date" => "date",
            ],
            "data" => $this->comments,
            "actions" => [
                "report" => "/bdfy-admin/comments/report?id=",
                "delete" => "/bdfy-admin/comments/delete?id=",
            ]
        ];
        
    }
}
