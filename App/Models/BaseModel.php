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
        // echo $this->query;
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

    public function update (array $data, string $column, string $value): int {
        $values = [];
        $columns = [];
        $param_count = count($values);
        try {
            $statement = "UPDATE " . $this->table. " SET ";
            foreach ($data as $key => $value) {
                if (in_array($key, $this->fillable)) {
                    array_push($columns, "$key = ?");
                    array_push($values, $value);
                }
            }
            $statement .= implode(',', $columns);
            $statement .= " WHERE $column = ?";
            $query = $this->conn->prepare($statement);
            for ($i = 1; $i <= $param_count; $i++) {
                if (gettype($values[$i - 1]) == "integer") 
                    $query->bindParam($i, $values[$i - 1], PDO::PARAM_INT);
                else
                    $query->bindParam($i, $values[$i - 1], PDO::PARAM_STR);
            }   
            
            $query->bindParam($i + 1, $value, PDO::PARAM_STR);

            dd($query->queryString);
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

    public function select(array $columns = []): Model {
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

    public function with(string $table, string $local_key, string $foreign_key): Model {
        $statement = " JOIN `$table` ON `$this->table`.`$local_key` = `$table`.`$foreign_key`";
        $this->query .= $statement;
        return $this;
    }

    public function order_by(string $order = "DESC", string $column = "id"): Model {
        $statement = " ORDER BY $column $order";
        $this->query .= $statement;
        return $this;
    }

    public function where(string $column, string $expression, string $value) {
        $statement = ' ';
        if (strpos($this->query, "WHERE")) {
            $statement .= "AND `$this->table`.`$column` $expression ?"; 
        } else {
            $statement .= "WHERE `$this->table`.`$column` $expression ?";
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
            $statement = "DELETE FROM `$this->table` WHERE `$this->table`.`$column` = :value";
            $query = $this->conn->prepare($statement);
            $query->bindParam(":value", $value, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public function count(string $column = '*'): Model {
        $statement = "SELECT COUNT($column) as count FROM `$this->table`";
        $this->query .= $statement;
        return $this;
    }

    public function length(): int {
        return count($this->result);
    }

    public function get() {
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

    public function get_query(): string {
        return $this->query;
    }
}