<?php
/**
 * Project:  phpMvc
 * FileName: Database.php
 * User:     abbass
 * Time:     22:41
 * Date:     2022/05/14
 */


namespace app\core;

use PDO;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $host = $config['db_host'];
        $dbName = $config['db_name'];
        $username = $config['db_user'];
        $password = $config['db_password'];

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
          } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }
}