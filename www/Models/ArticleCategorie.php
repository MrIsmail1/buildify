<?php


namespace App\Models;


use App\Core\Db;

class ArticleCategorie extends Db
{
    protected Int $id;
    protected Int $categorie_id;
    protected Int $article_id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdCategory($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    public function getIdCategory()
    {
        return $this->categorie_id;
    }

    public function setIdArticle($article_id)
    {
        $this->article_id = $article_id;
    }

    public function getIdArticle()
    {
        return $this->article_id;
    }

    public function deleteByCategory(Int $categorie_id)
    {
        return $this->delete(["categorie_id" => $categorie_id]);
    }


}