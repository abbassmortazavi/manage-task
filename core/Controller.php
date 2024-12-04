<?php


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