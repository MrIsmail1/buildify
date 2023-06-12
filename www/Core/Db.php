<?php

namespace App\Core;

use PDO;

abstract class Db
{
    private static $instance = null;
    private $pdo;
    private $table;

    protected function __construct()
    {
        try {
            $this->pdo = new \PDO("pgsql:host=postgres-Database;dbname=Challenge_Stack;port=5432", "ESGI", "ESGI2023");
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = "challenge_stack." . end($classExploded);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function read($filter = null): array
    {
        $query = "SELECT * FROM " . $this->table;
        $params = [];
        if ($filter !== null) {
            $query .= " WHERE ";
            $conditions = [];
            foreach ($filter as $key => $value) {
                $conditions[] = "$key=:$key";
                $params[":$key"] = $value;
            }
            $query .= implode(" AND ", $conditions);
        }
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(array $data, string $idColumn, int $idValue): void
    {
        $query = "UPDATE " . $this->table . " SET ";
        $params = [];
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key=:$key";
            $params[":$key"] = $value;
        }
        $query .= implode(", ", $set);
        $query .= " WHERE $idColumn=:$idColumn";
        $params[":$idColumn"] = $idValue;
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    }



    /* public function exists(): void
    {
        $columns = get_object_vars($this);
        $columnsToDeleted = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToDeleted);
        $query = "SELECT * FROM " . $this->table . " WHERE ";
        $params = [];
        foreach ($columns as $key => $value) {
            $query .= $key . "=:" . $key . " AND ";
            $params[":" . $key] = $value;
        }
        $query = rtrim($query, " AND ");
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    } */
}
