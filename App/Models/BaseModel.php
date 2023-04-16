<?php
namespace App\Models;
use PDO;
use App\Models\Database;
use App\Interfaces\Model;
use PDOException;

class BaseModel extends Database implements Model {
    protected $conn;
    protected $table;   // Table the child class is connected to
    protected $result;

    public function __construct () {
        $this->conn = $this->connect();
        $this->result = [];
    }

    public function all() {
        $statement = "SELECT * FROM " . $this->table;   // IMPORTANT: NEED TO FIX THIS LATER!
        $query = $this->conn->prepare($statement);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this; 
    }
    
    public function find($id) {
        $statement = "SELECT * FROM ". $this->table . " WHERE `id` = :id";
        $query = $this->conn->prepare($statement);
        $query->bindParam(":id", $id);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this; 
    }

    public function where($column, $expression, $value) {
        $statement = "SELECT * FROM ". $this->table . " WHERE ". $column ." ". $expression ." :value";
        $query = $this->conn->prepare($statement);
        $query->bindParam(":value", $value, PDO::PARAM_STR);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this; 
    }

    public function delete($column, $value) {
        try {
            $statement = "DELETE FROM " . $this->table . " WHERE ". $column . " = :value";
            $query = $this->conn->prepare($statement);
            $query->bindParam(":value", $value, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function count() {
        return count($this->result);
    }

    public function get() {
        if (!$this->result) 
            return null;

        return $this->result;
    }

    public function first() {
        if (count($this->result) < 1) 
            return null;
        return $this->result[0];
    }

    public function take($limit, $start = 0) {
        if (count($this->result) < $limit) {
            return $this->result;
        }

        $result = array_slice($this->result, $start, ($limit + $start));
        return $result;
    }
}