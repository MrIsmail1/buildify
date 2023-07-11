<?php

namespace App\Models;

use App\Core\Db;

class Template extends Db
{
    protected Int $id;
    protected String $color = "#000000";
    protected String $font_family = "Times New Roman, serif";
    protected String $font_size = "16";
    protected Int $page_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getColor()
    {
        return $this->color;
    }
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function getFontFamily()
    {
        return $this->font_family;
    }
    public function setFontFamily($font_family)
    {
        $this->font_family = $font_family;
    }
    public function getFontSize()
    {
        return $this->font_size;
    }
    public function setFontSize($font_size)
    {
        $this->font_size = $font_size;
    }
    public function getPageId()
    {
        return $this->page_id;
    }
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }
    public function getTemplatePageById($id)
    {
        return $this->read(["page_id" => $id]);
    }
    public function deleteTemplateByPageId($id)
    {
        return $this->delete(["page_id" => $id]);
    }
}
