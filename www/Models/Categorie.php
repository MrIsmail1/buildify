<?php

namespace App\Models;

use App\Core\Db;

class Categorie extends Db
{
    protected Int $id;
    protected String $title;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getAllCategories()
    {
        return $this->read();
    }

    public function getCategorieByTitle(string $title)
    {
        return $this->read(["title" => $title]);
    }

    public function getCategorieById($id)
    {
        return $this->read(["id" => $id]);
    }

    public function deleteCategorieById(Int $id)
    {
        return $this->delete(["id" => $id]);
    }

    public function updateTitle(string $title,$id)
    {
        $this->update(["title" => $title], "id", $id);
    }

    public function getCategorieTitleById($id)
    {
        $categorie = $this->read(["id" => $id]);
        if (!empty($categorie)) {
            return $categorie[0]['title'];
        }
        return null;
    }

}