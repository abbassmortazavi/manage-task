<?php

namespace app\core;
class Router
{
    public Request $request;
    protected array $routes = [];
    public Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
//            Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
//            return $this->renderContent("not found");
            return $this->renderView("404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback))
        {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback , $this->request);
    }

    /**
     * @param string $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView(string $view , $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view , $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
        //include_once Application::$ROOT_DIR . "/views/$view.php";
    }

    private function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @return false|string
     */
    private function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param $params
     * @return false|string
     */
    private function renderOnlyView(string $view , $params)
    {
        foreach ($params as $key=>$value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}