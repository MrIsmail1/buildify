<?php
require_once __DIR__.'/../vendor/autoload.php'; 

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); 
        $dotenv->load();

        $this->host = 'localhost:8300';
        $this->db_name = getenv('POSTGRES_DB');
        $this->username = getenv('POSTGRES_USER');
        $this->password = getenv('POSTGRES_PASSWORD');
    }

    // obtenir la connexion à la base de données
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
