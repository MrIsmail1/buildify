<?php 
namespace App\Models;

use App\Core\Db;

class Comments extends Db
{
    protected int $id;
    protected int $article_id;
    protected int $userid; 
    protected int $idpage ;
    protected int $article_id;
    protected string $content;
    protected string $date;
    protected string $comment_author;
    protected bool $reported = false; 

    /**
     * @return int
     */
    public function getIdCommentPage(): int
    {
        return $this->id;
    }

    /**
     * @param int $idCommentPage
     */
    public function setIdCommentPage(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        
        return $this->userid;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return int
     */
    public function getIdPage(): int
    {
        return $this->idpage;
    }

    /**
     * @param int $idPage
     */
    public function setIdPage(int $idpage): void
    {
        $this->idpage = $idpage;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }  

    /**
     * Méthode pour récupérer les commentaires d'une page spécifique
     */
    public function getCommentsForPage(int $idpage)
    {
        return $this->read(["idpage" => $idpage]);
    }
    
    public function getCommentsByPageId(int $idpage){
        return $this->read(["idpage" => $idpage]);
    }

        
    public function getAllComments(){
        return $this->read();
    }

    public function deleteCommentById(int $id){
        return $this->delete(["id" => $id]);
    }
    
    public function getCommentAuthor()
    {
        return $this->comment_author;
    }

    public function setCommentAuthor($commentAuthor){
        $this->comment_author = $commentAuthor;

    }
    
    
    
    public function getReported(): bool
    {
        return $this->reported;
    }

    /**
     * @param bool $reported
     */
    public function setReported(bool $reported): void
    {
        $this->reported = $reported;
    }

    public function reportCommentById(int $id) {
        $this->update(["reported" => true], "id", $id);
    }

    public function CommentReported(int $id){
        return $this->read(["id" => $id]);
        $result = $this->read(["id" => $id]);
        if (!empty($result)) {
            return $result[0]["reported"];
        } else {
            return null;
        }
    }

    public function addComment(string $content, string $author, int $articleId)
    {
        $commentData = [
            "content" => $content,
            "comment_author" => $author,
            "idpage" => $articleId,            
        ];
        return $this->create($commentData);
    }
    
    

    public function getCommentsForArticle(int $article_id){
        return $this->read(["article_id" => $article_id]);
    }

    public function setIdArticle(int $article_id)
    {
        $this->article_id = $article_id; 
    }
}
   