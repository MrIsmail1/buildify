<?php

namespace App\Core;

use PDO;

abstract class Db
{
    private static $instance = null;
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $config = require('Config.php');
        try {
            $this->pdo = new PDO(
                "pgsql:host=" . $config['dbHost'] . ";dbname=" . $config['dbName'] . ";port=5432",
                $config['dbUsername'],
                $config['dbPassword']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = "challenge_stack." . end($classExploded); // Détermination du nom de la table en fonction du nom de la classe
    }

    // Méthode pour récupérer l'instance de la classe
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    //Méthode pour créer la base de données
    public function createDatabase($query)
    {
        if (!empty($query)) {
            $query = $this->pdo->exec($query);
            return true;
        }
        return false;
    }

    // Méthode pour récupérer les enregistrements de la table
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

    // Méthode pour mettre à jour un enregistrement dans la table
    public function update(array $data, string $idColumn, int $idValue): void
    {
        $query = "UPDATE " . $this->table . " SET ";
        $params = [];
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key=:$key";
            $params[":$key"] = $value;
            if (is_bool($value)) {
                $params[":$key"] = $value ? 1 : 0;
            }
        }
        $query .= implode(", ", $set);
        $query .= " WHERE $idColumn=:$idColumn";
        $params[":$idColumn"] = $idValue;
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute($params);
    }

    public function delete($filter = null): int
    {
        $query = "DELETE FROM " . $this->table;
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
        return $queryPrepared->rowCount();
    }

    public function create(): void
    {
        $columns = get_object_vars($this);

        $columnsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToExclude);

        foreach ($columns as $key => $value) {
            if (is_bool($value)) {
                $columns[$key] = $value ? 1 : 0;
            }
        }

        $queryPrepared = $this->pdo->prepare("INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") 
                                VALUES (:" . implode(",:", array_keys($columns)) . ")");

        $queryPrepared->execute($columns);
    }

    /*  public function deleteByForeignKey($foreignKey, $foreignKeyValue)
    {
        $query = "DELETE FROM " . $this->table . " WHERE $foreignKey = :value";
        $queryPrepared = $this->pdo->prepare($query);
        $queryPrepared->execute(['value' => $foreignKeyValue]);
        return $queryPrepared->rowCount();
    } */
}
