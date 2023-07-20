<?php

namespace App\Models;

use App\Core\Db;
use App\Models\Page;
use App\Models\Comments;


class Dashboard extends Db
{
    protected int $id;
    protected int $idpage;
    protected int $idcommment;
    

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $iddashboard
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getIdPage(): int
    {
        return $this->idpage;
    }
    
    
    /**
     * @param string|null $id_page
     */
    public function setIdPages(int $idpage): void
    {
        $this->idpage = $idpage;
    }

    
    public function getTotalPages()
    {

        $page = new Page();
        return count($page->getAllPages());
    }
  
    
    public function getTotalComments()
    {
       $comment = new Comments();
        return count($comment->getAllComments());
    }

        
    public function getLastPages($limit = 5)
    {
        $page = new Page();
        $allPages = $page->getAllPages();
        return array_slice($allPages, -$limit);
    }

    public function getLastComments($limit = 5)
    {
        $comment = new Comments();
        $allComments = $comment->getAllComments();
        return array_slice($allComments, -$limit);
    }
}
