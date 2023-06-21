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

    public function getTotalPages()
    {
    // Écrivez votre requête SQL pour obtenir le nombre total de pages
    $sql = "SELECT COUNT(*) FROM challenge_stack.page"; // Utilisez "challenge_stack.page" au lieu de "page"
    $result = $this->getPDO()->query($sql);
    return $result->fetchColumn();
    }



    public function getTotalPosts()
    {
        // Écrivez votre requête SQL pour obtenir le nombre total de posts
        $sql = "SELECT COUNT(*) FROM challenge_stack.posts"; // Utilisez "challenge_stack.posts" au lieu de "posts"
        $result = $this->getPDO()->query($sql);
        return $result->fetchColumn();
    }

    public function getTotalComments()
    {
        // Écrivez votre requête SQL pour obtenir le nombre total de commentaires
        $sql = "SELECT COUNT(*) FROM challenge_stack.comment_page";
        $result = $this->getPDO()->query($sql);
        return $result->fetchColumn();
    }

    public function create(string $tableName, array $data): bool
{
    $sql = "INSERT INTO $tableName (id_pages, date_publication, dashboardcol, id_commentpage, commentaireamoderer) VALUES (:id_pages, :date_publication, :dashboardcol, :id_commentpage, :commentaireamoderer)";
    $query = $this->getPDO()->prepare($sql);
    return $query->execute([
        'id_pages' => $data['id_pages'],
        'date_publication' => $data['date_publication'],
        'dashboardcol' => $data['dashboardcol'],
        'id_commentpage' => $data['id_commentpage'],
        'commentaireamoderer' => $data['commentaireamoderer']
    ]);
}


    public function update(array $data, string $idColumn, int $idValue): void
    {
    $sql = "UPDATE challenge_stack.dashboard SET id_pages = :id_pages, date_publication = :date_publication, dashboardcol = :dashboardcol, id_commentpage = :id_commentpage, commentaireamoderer = :commentaireamoderer WHERE $idColumn = :conditionValue";
    $query = $this->getPDO()->prepare($sql);
    $query->execute([
        'id_pages' => $data['id_pages'],
        'date_publication' => $data['date_publication'],
        'dashboardcol' => $data['dashboardcol'],
        'id_commentpage' => $data['id_commentpage'],
        'commentaireamoderer' => $data['commentaireamoderer'],
        'conditionValue' => $idValue
    ]);
    }

    public function delete(string $tableName, string $idColumn, $idValue): bool
    {
        $allowedColumns = ['iddashboard', 'id_pages', 'date_publication', 'dashboardcol', 'id_commentpage', 'commentaireamoderer'];
        if (!in_array($idColumn, $allowedColumns)) {
            throw new \InvalidArgumentException("Invalid column name $idColumn");
        }

        $sql = "DELETE FROM $tableName WHERE $idColumn = :conditionValue";
        $query = $this->getPDO()->prepare($sql);
        return $query->execute(['conditionValue' => $idValue]);
    }


    public function getDashboardById($id)
    {
    $sql = "SELECT * FROM challenge_stack.dashboard WHERE iddashboard = :id";
    $query = $this->getPDO()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
    }

    public function getAllDashboards()
    {
    $sql = "SELECT * FROM challenge_stack.dashboard";
    $query = $this->getPDO()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
    }
    
    public function getLatestPosts(){
        $sql = "SELECT * FROM challenge_stack.comment_page ORDER BY idcomment_page DESC LIMIT 5"; 
        $query = $this->getPDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();

    }
    
    public function getLatestComments(){
        $sql = "SELECT * FROM challenge_stack.page ORDER BY idpage DESC LIMIT 5"; 
        $query = $this->getPDO()->prepare($sql);
        $query->execute();
        return $query->fetchAll();

    }
}
