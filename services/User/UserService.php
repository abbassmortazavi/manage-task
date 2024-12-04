<?php
/**
 * UserService.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:50
 */
namespace app\services\User;


use app\models\RegisterModel;

class UserService implements UserInterface
{
    protected RegisterModel $registerModel;
    public function __construct($registerModel)
    {
        $this->registerModel =$registerModel;
    }

    public function register(array $attributes): mixed
    {
       // $model = $this->registerModel->register();
        $name = $attributes['name'];
        $email = $attributes['email'];
        $password = password_hash($attributes['password'], PASSWORD_BCRYPT);
        $role = $attributes['role'];
        $this->registerModel->register($name, $email, $password, $role);
        return json_encode("successfully");

    }
}