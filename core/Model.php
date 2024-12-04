<?php

namespace app\core;



class Model
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database(); // Initialize the database connection
    }


}