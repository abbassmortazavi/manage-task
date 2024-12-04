<?php
/**
 * Project:  phpMvc
 * FileName: Model.php
 * User:     abbass
 * Time:     20:02
 * Date:     2022/04/30
 */

namespace app\core;

class Model
{
    public function __construct(protected Database $db)
    {
    }
}