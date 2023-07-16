<?php

namespace App\Models;

use App\Core\Db;

class Dashboard extends Db
{
    protected int $id;
    protected int $idpage;
    protected int $idcommment;
    protected string $date;
    protected string $commentaireamoderer;

    /**
     * @return int
     */
    public function getIddashboard(): int
    {
        return $this->id;
    }

    /**
     * @param int $iddashboard
     */
    public function setIddashboard(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getIdPages(): ?string
    {
        return $this->idpages;
    }

    /**
     * @param string|null $id_page
     */
    public function setIdPages(?string $idpage): void
    {
        $this->idpage = $idpage;
    }

    /**
     * @return string|null
     */
    public function getDatePublication(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date_publication
     */
    public function setDatePublication(?string $date): void
    {
        $this->date = $date;
    }

    

    /**
     * @return string|null
     */
    public function getIdCommentPage(): ?string
    {
        return $this->idcomment;
    }

    /**
     * @param string|null $id_commentpage
     */
    public function setIdCommentPage(?string $idcomment): void
    {
        $this->idcomment = $idcomment;
    }

    /**
     * @return string|null
     */
    public function getCommentaireAModerer(): ?string
    {
        return $this->commentaireamoderer;
    }

    /**
     * @param string|null $commentaireamoderer
     */
    public function setCommentaireAModerer(?string $commentaireamoderer): void
    {
        $this->commentaireamoderer = $commentaireamoderer;
    }

    public function getTotalPages()
    {
        return $this->read();
    }

    public function getLastPages(){

    }

    
    public function getTotalComments()
    {
       return $this->read();
    }

        
    public function getLatestComments(){
        
    }
}
