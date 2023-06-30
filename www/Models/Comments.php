<?php 
namespace App\Models;

use App\Core\Db;

class Comments extends Db
{
    protected int $idCommentPage;
    protected int $idUser; 
    protected int $idPage ;
    protected string $content;
    protected string $date;

    /**
     * @return int
     */
    public function getIdCommentPage(): int
    {
        return $this->idCommentPage;
    }

    /**
     * @param int $idCommentPage
     */
    public function setIdCommentPage(int $idCommentPage): void
    {
        $this->idCommentPage = $idCommentPage;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getIdPage(): int
    {
        return $this->idPage;
    }

    /**
     * @param int $idPage
     */
    public function setIdPage(int $idPage): void
    {
        $this->idPage = $idPage;
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
    public function getDateCreationPublication(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDateCreationPublication(string $date): void
    {
        $this->date = $date;
    }  

    /**
     * Méthode pour récupérer les commentaires d'une page spécifique
     */
    public function getCommentsForPage(int $idPage)
    {
        return $this->read(["page_id" => $idPage]);
    }
    
    public function getAllComments(){
        return $this->read();
    }
    // Autres méthodes liées aux commentaires (suppression, modification, etc.)
}
