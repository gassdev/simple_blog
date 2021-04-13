<?php

require_once 'libraries/database.php';

/**
 * Model
 */
class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = getPdo();
    }
}