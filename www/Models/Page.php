<?php

namespace App\Models;

use App\Core\Db;
use DateTime;

class Page extends Db
{
    protected Int $id;
    protected String $pageTitle;
    protected String $pageAuthor;
    protected String $last_modified;
    protected String $last_published;
    protected String $content;
    protected String $slug;
    protected Int $user_id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }
    public function getPageAuthor()
    {
        return $this->pageAuthor;
    }
    public function setPageAuthor($pageAuthor)
    {
        $this->pageAuthor = $pageAuthor;
    }
    public function getLast_modified()
    {
        return $this->last_modified;
    }
    public function setLast_modified($last_modified)
    {
        $this->last_modified = $last_modified;
    }
    public function getLast_published()
    {
        return $this->last_published;
    }
    public function setLast_published($last_published)
    {
        $this->last_published = $last_published;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function setSlug($slug)
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower($slug));
        $this->slug = trim($slug, '-');
    }
    public function getAllPages()
    {
        return $this->read();
    }
    public function getPageById($id)
    {
        return $this->read(["id" => $id]);
    }
    public function deletePageById(Int $id)
    {
        return $this->delete(["id" => $id]);
    }
    public function getLastCreatedId()
    {
        return $this->pdo->LastInsertId();
    }
}
