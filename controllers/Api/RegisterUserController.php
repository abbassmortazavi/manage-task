<?php
/**
 * GithubController.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from mvc
 * @version 1.0.0
 * @date 2023/09/25 18:03
 */


namespace app\controllers\Api;

use app\core\Controller;
use app\core\Request;


class RegisterUserController extends Controller
{


    public function __construct()
    {

    }


    public function register(Request $request)
    {
        var_dump($request->getBody());
        die();
        try {
            return $this->service->lists($request->getBody());
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }
}