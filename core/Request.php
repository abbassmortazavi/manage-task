<?php

namespace app\core;

class Request
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path , '?');
        if ($position === false)
        {
            return $path;
        }
        return substr($path , 0 , $position);
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get')
        {
            foreach ($_GET as $key=>$value)
            {
                $body[$key] = filter_input(INPUT_GET , $key , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post')
        {
            foreach ($_POST as $key=>$value)
            {
                $body[$key] = filter_input(INPUT_POST , $key , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}