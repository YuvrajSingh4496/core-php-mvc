<?php
namespace App\Models;
use PDO;
use App\Models\Database;
use App\Interfaces\Model;

class BaseModel extends Database implements Model {
    protected $conn;
    protected $table;  // Table this model is connected to
    protected $result;

    public function __construct () {
        $this->conn = $this->connect();
        $this->result = null;
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
        // $query->bindParam(":table", $this->table);
        $query->bindParam(":id", $id);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this; 

    }
    public function where($data, $expression, $value) {}
    public function count() {}

    public function get() {
        if (!$this->result) return false;

        return $this->result;
    }
    public function first() {
        if (!$this->result) return null;     
        if (count($this->result) < 1) return [];

        return $this->result[0];

    }
}