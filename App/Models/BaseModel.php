<?php
namespace App\Models;
use PDO;
use App\Models\Database;
use App\Interfaces\Model;
use PDOException;

class BaseModel extends Database implements Model {
    protected $conn;
    protected array $fillable;
    protected string $table;   // Table the child class is connected to
    protected array $result;
    protected array $showable;
    protected string $query;
    protected array $params;

    public function __construct () {
        $this->conn = $this->connect();
        $this->result = [];
        $this->query = "";
        $this->params = [];
    }

    public function execute(): Model {
        $query = $this->conn->prepare($this->query);
        $params = $this->params;
        $param_count = count($params);
        if ($param_count) {
            for ($i = 1; $i <= $param_count; $i++) {
                if (gettype($params[$i - 1]) == "integer") 
                    $query->bindParam($i, $params[$i - 1], PDO::PARAM_INT);
                else
                    $query->bindParam($i, $params[$i - 1], PDO::PARAM_STR);
            }   
        }
        $query->execute();
        $this->result = $query->fetchAll();
        $this->query = ""; 
        $this->params = [];
        return $this;
    }

    public function create ($data): int {
        $values = [];
        $placeholder = [];
        $columns = implode(',', $this->fillable);
        foreach ($this->fillable as $column) {
            array_push($placeholder, "?");
            array_push($values, $data[$column]);
        }

        $placeholder = implode(',', $placeholder);
        $param_count = count($values);
        try {
            $statement = "INSERT INTO " . $this->table . "($columns) VALUES($placeholder)";
            $query = $this->conn->prepare($statement);
            for ($i = 1; $i <= $param_count; $i++) {
                if (gettype($values[$i - 1]) == "integer") 
                    $query->bindParam($i, $values[$i - 1], PDO::PARAM_INT);
                else
                    $query->bindParam($i, $values[$i - 1], PDO::PARAM_STR);
            }   

            $query->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function all(): Model {
        $statement = "SELECT * FROM " . $this->table;   // IMPORTANT: NEED TO FIX THIS LATER!
        $this->query .= $statement;
        return $this; 
    }
    
    public function find(int $id): Model {
        $statement = "SELECT * FROM ". $this->table . " WHERE `id` = :id";
        $query = $this->conn->prepare($statement);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $this->result = $query->fetch();
        return $this;
    }

    public function select(array $columns = []) {
        if (count($columns) < 1) {
            $columns = implode(',', $this->showable);
        } else {
            $columns = implode(',', $columns);
        }
        $statement = "SELECT $columns FROM ". $this->table;
        $this->query .= $statement;
        // array_push($this->params, $columns);
        return $this;
    }

    public function where(string $column, string $expression, string $value) {
        $statement = ' ';
        if (strpos($this->query, "WHERE")) {
            $statement .= "AND $column $expression ?"; 
        } else {
            $statement .= "WHERE $column $expression ?";
        }

        $this->query .= $statement;
        array_push($this->params, $value);
        return $this; 
    }

    public function limit(int $limit, int $start = 0) {
        $statement = " LIMIT ?, ?";
        $this->query .= $statement;
        array_push($this->params, $start, $limit);
        return $this;
        
    }
    public function delete(string $column, string $value): bool {
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

    public function count(string $column = '*'): Model {
        $statement = "SELECT COUNT($column) as count FROM ". $this->table;
        $this->query .= $statement;
        return $this;
    }

    public function length(): int {
        return count($this->result);
    }

    public function get() {
        if (!$this->result) 
            return [];

        return $this->result;
    }

    public function first() {
        if (count($this->result) < 1) 
            return null;
        return $this->result[0];
    }

    public function take(int $amount, int $offset = 0) {
        if (count($this->result) < $amount) {
            return $this->result;
        }

        $result = array_slice($this->result, $offset, ($amount + $offset));
        return $result;
    }

}