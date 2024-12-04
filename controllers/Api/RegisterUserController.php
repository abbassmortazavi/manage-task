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
use app\core\Request;
use app\models\RegisterModel;
use OpenApi\Annotations as OA;


class RegisterUserController extends Controller
{


    /**
     * @OA\Post(
     *     path="/api/user/register",
     *     summary="Register a new user",
     *     description="Registers a new user by providing name, email, password, and role.",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="The name of the user",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="The email of the user",
     *         required=true,
     *         @OA\Schema(type="string", format="email")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="The password for the user account",
     *         required=true,
     *         @OA\Schema(type="string", format="password")
     *     ),
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="Role of the user, e.g., admin or user",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User registration successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User registered successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad request, invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Invalid input data")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthorized, invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
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
