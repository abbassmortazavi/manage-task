<?php
/**
 * UserInterface.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:57
 */
namespace app\services\User;
interface UserInterface
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function register(array $attributes): mixed;
}