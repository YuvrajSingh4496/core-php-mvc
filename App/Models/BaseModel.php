<?php
namespace App\Models;
use PDO;
use App\Models\Database;
use App\Interfaces\Model;

class BaseModel extends Database implements Model {
    protected $conn;
    protected $table;  // Table the child class is connected to
    protected $result;

    public function __construct () {
        $this->conn = $this->connect();
        $this->result = [];
    }


    public function all() {
        // IMPORTANT: NEED TO FIX THIS LATER!
        $statement = "SELECT * FROM " . $this->table;
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
        // $query->bindParam(":column", $column, PDO::PARAM_STR);
        // $query->bindParam(":expression", $expression, PDO::PARAM_STR_CHAR);
        $query->bindParam(":value", $value, PDO::PARAM_STR);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this; 
    }

    public function count() {
        return count($this->result);

    }

    public function get() {
        if (!$this->result) return null;

        return $this->result;
    }
    public function first() {    
        if (count($this->result) < 1) return null;

        return $this->result[0];

    }
}