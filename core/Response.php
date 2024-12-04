<?php
/**
 * Project:  phpMvc
 * FileName: Response.php
 * User:     abbass
 * Time:     14:42
 * Date:     2022/04/28
 */

namespace app\core;

class Response
{
    /**
     * @param int $code
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }
}