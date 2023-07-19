<?php

namespace App\Models;

use App\Core\Db;

class PageMemento extends Db
{
    protected Int $id;
    protected String $pageTitle;
    protected String $content;
    protected String $slug;
    protected String $save_date;
    protected Int $page_id;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
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
    public function getPageId()
    {
        return $this->content;
    }
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }
    public function getSaveDate()
    {
        return $this->save_date;
    }
    public function setSaveDate($save_date)
    {
        $this->save_date = $save_date;
    }
}
