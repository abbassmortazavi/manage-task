<?php
/**
 * RegisterUserController.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:50
 */


namespace app\controllers\Api;

use app\core\Controller;
use app\core\Database;
use app\core\Request;
use app\models\RegisterModel;
use app\services\User\UserService;


class RegisterUserController extends Controller
{

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function register(Request $request): mixed
    {
        try {
            return $this->prepareData($request->getBody());
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function prepareData(array $attributes): bool
    {
        $name = $attributes['name'];
        $email = $attributes['email'];
        $password = password_hash($attributes['password'], PASSWORD_BCRYPT);
        $role = $attributes['role'];
        $model = new RegisterModel();
        return $model->register($name, $email, $password, $role);
    }
}