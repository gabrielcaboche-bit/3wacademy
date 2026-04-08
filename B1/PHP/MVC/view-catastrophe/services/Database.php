<?php

namespace database;

use PDO;

class Database
{
    private $host = "localhost";
    private $db = "blog";
    private $user = "root";
    private $pass = "";
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->host;charset=utf8;dbname=$this->db", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }
}