<?php
class Database
{
    private $host = "localhost";
    private $dbname = "products";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die($this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->conn;
    }
}
