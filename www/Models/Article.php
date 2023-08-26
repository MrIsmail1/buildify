<?php

namespace App\Models;

use App\Core\Db;

class Article extends Db
{
    protected Int $id;
    protected String $articleTitle;
    protected String $articleAuthor;
    protected String $last_modified;
    protected String $last_published;
    protected String $content;
    protected String $slug;
    protected Int $user_id;
    protected Int $categorie_id;  // ancien categorie id a supprimer apres 
    protected Int $categoryId;  // categorie id de la table article 
    

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
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;
    }

    public function getCategorie() {
        return $this->categorie_id;
    }

    public function setCategorie($categorie_id) {
        $this->categorie_id=$categorie_id;
    }

    public function getArticleAuthor()
    {
        return $this->articleAuthor;
    }
    public function setArticleAuthor($articleAuthor)
    {
        $this->articleAuthor = $articleAuthor;
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
        $date = new \DateTime($last_published);
        $this->last_published = $date->format('Y-m-d H:i:s');
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
    public function getAllArticles()
    {
        return $this->read();
    }
    public function getArticleById($id)
    {
        return $this->read(["id" => $id]);
    }
    public function deleteArticleById(Int $id)
    {
        return $this->delete(["id" => $id]);
    }
    public function getLastCreatedId()
    {
        return $this->pdo->LastInsertId();
    }
    
    public function findArticleByUrl($url)
    {
        return $this->read(["slug" => $url]);
    }
    public function findSlug($slug)
    {
        return $this->read(["slug" => $slug]);
    }

    public function updateCategoryWhenCategoryDeleted($categoryId)
    {
        // Définissez la nouvelle catégorie par défaut (ou null si vous préférez)
        $newCategoryId = null; // Remplacez par l'ID de la nouvelle catégorie si nécessaire

        // Mettez à jour les articles restants en affectant la nouvelle catégorie ou en laissant la colonne categorie_id à NULL
        $data = ['categorie_id' => $newCategoryId];
        $this->update($data, 'categorie_id', $categoryId);
    }

    public function setCategorie_id($categorie_id) {
        $this->categorie_id = $categorie_id;
    }
    public function getCategorie_id() {
        return $this->categorie_id;
    }

    // Dans la classe Article

    public function getCommentsForArticle($id)
    {
        $commentsModel = new Comments(); // Instanciez le modèle de commentaires
        return $commentsModel->read(["article_id" => $id]); // Utilisez le modèle pour récupérer les commentaires
    }
    
    

    
}