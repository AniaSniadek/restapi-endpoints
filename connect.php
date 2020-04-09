<?php

class Database
{
    private $host = ""; //your host
    private $db_name = ""; //your database name
    private $username = ""; //your username
    private $password = ""; //your password
    public $conn;

    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
