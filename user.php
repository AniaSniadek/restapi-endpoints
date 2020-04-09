<?php

class User
{
    private $conn;
    private $table_name = 'users';

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT id, name, email, password FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
