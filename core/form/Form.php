<?php
/**
 * Project:  phpMvc
 * FileName: Form.php
 * User:     abbass
 * Time:     22:08
 * Date:     2022/04/30
 */

namespace app\core\form;

use app\core\Model;

class Form
{
    /**
     * @param $action
     * @param $method
     * @return Form
     */
    public static function begin($action , $method): Form
    {
        echo sprintf('<form action="%s" method="%s">' , $action , $method);
        return new Form();
    }

    /**
     * @return string
     */
    public static function end(): string
    {
        return '</form>';
    }

    /**
     * @param Model $model
     * @param $attributes
     * @return Field
     */
    public function field(Model $model , $attributes): Field
    {
        return new Field($model , $attributes);
    }
}