<?php

namespace App\Models;

use App\Core\Db;

class Dashboard extends Db
{
    protected int $iddashboard;
    protected ?string $id_page;
    protected ?string $date_publication;
    protected ?string $dashboardcol;
    protected ?string $id_commentpage;
    protected ?string $commentaireamoderer;

    /**
     * @return int
     */
    public function getIddashboard(): int
    {
        return $this->iddashboard;
    }

    /**
     * @param int $iddashboard
     */
    public function setIddashboard(int $iddashboard): void
    {
        $this->iddashboard = $iddashboard;
    }

    /**
     * @return string|null
     */
    public function getIdPages(): ?string
    {
        return $this->id_pages;
    }

    /**
     * @param string|null $id_pages
     */
    public function setIdPages(?string $id_pages): void
    {
        $this->id_pages = $id_pages;
    }

    /**
     * @return string|null
     */
    public function getDatePublication(): ?string
    {
        return $this->date_publication;
    }

    /**
     * @param string|null $date_publication
     */
    public function setDatePublication(?string $date_publication): void
    {
        $this->date_publication = $date_publication;
    }

    /**
     * @return string|null
     */
    public function getDashboardCol(): ?string
    {
        return $this->dashboardcol;
    }

    /**
     * @param string|null $dashboardcol
     */
    public function setDashboardCol(?string $dashboardcol): void
    {
        $this->dashboardcol = $dashboardcol;
    }

    /**
     * @return string|null
     */
    public function getIdCommentPage(): ?string
    {
        return $this->id_commentpage;
    }

    /**
     * @param string|null $id_commentpage
     */
    public function setIdCommentPage(?string $id_commentpage): void
    {
        $this->id_commentpage = $id_commentpage;
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
}
