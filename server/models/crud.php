<?php
class Task
{
    private $conn;
    private $table = 'products';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getProduct($name)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createProduct($name, $price, $category)
    {
        $query = "INSERT INTO " . $this->table . " (name, price, category) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sds", $name, $price, $category);
        return $stmt->execute();
    }

    public function updateProduct($name, $price, $category)
    {
        $query = "UPDATE " . $this->table . " SET name=?, price=?, category=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsi", $name, $price, $category, $id);
        return $stmt->execute();
    }

    public function deleteProduct($name)
    {
        $query = "DELETE FROM " . $this->table . " WHERE name=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }
}
