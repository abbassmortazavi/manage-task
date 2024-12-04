<?php
/**
 * Project:  phpMvc
 * FileName: ${FILE_NAME}
 * User:     abbass
 * Time:     19:42
 * Date:     2022/04/30
 */

namespace app\models;

use app\core\Application;
use app\core\Database;
use app\core\Model;

class RegisterModel extends Model
{

    public function register($name, $email, $password, $role) {
        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

}