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
        $this->table = end($classExploded);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function read($id = null): array
    {
        $query = "SELECT * FROM " . $this->table;
        $params = [];
        if ($id !== null) {
            $query .= " WHERE id=:id";
            $params[':id'] = $id;
        }
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
        return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    }


    /*   public function exists(): void
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
