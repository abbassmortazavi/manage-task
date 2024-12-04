<?php


namespace app\core;

use PDO;
use PDOException;

class Database
{

    public \PDO $pdo;

    public function __construct()
    {
        $host = '172.28.0.2';
        $dbName = "task_management";
        $username = 'root';
        $password = 'root';


        try {
            $this->pdo = new PDO(
                "mysql:host={$host};dbname={$dbName}",
                $username,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }








       /* try {
            $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
          } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }*/
    }

    // Method to get the PDO instance (for query execution)
    public function getPDO() {
        return $this->pdo;
    }

    // Method for executing SELECT queries
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return as associative array
    }

    // Method for executing INSERT/UPDATE/DELETE queries
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params); // Returns true on success, false on failure
    }
}