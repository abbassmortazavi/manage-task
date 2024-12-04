<?php

/**
 * RegisterModel.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:50
 */
namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{


    public function register($name, $email, $password, $role) {

        var_dump($name,$email,$password,$role);
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        return $this->db->execute($query, [$name, $email, $password, $role]);
    }

}