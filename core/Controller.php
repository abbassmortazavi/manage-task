<?php
/**
 * Project:  phpMvc
 * FileName: Controller.php
 * User:     abbass
 * Time:     16:15
 * Date:     2022/04/28
 */

namespace app\core;

class Controller
{
    public string $layout = 'main';

    /**
     * @param $layout
     * @return void
     */
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }
    /**
     * @param $view
     * @param $params
     * @return array|false|string|string[]
     */
    public function render($view , $params=[])
    {
        return Application::$app->router->renderView($view , $params);
    }
}