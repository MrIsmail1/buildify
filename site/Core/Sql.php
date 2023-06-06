<?php

abstract class Sql
{
    private $pdo;
    private $table;

    public function __construct()
    {
        //Mettre en place un SINGLETON
        try {
            $this->pdo = new \PDO("pgsql:host=postgres-Database;port=5432;dbname=Challenge_Stack", "ESGI", "ESGI2023");
        } catch (\Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
        $classExploded = explode("\\", get_called_class());
        $this->table = end($classExploded);
        $this->table = "esgi_" . $this->table;
    }
}
