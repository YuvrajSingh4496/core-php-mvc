<?php 

namespace App\Models;

use PDOException;

class User extends BaseModel {
    protected $table = "users";
    
    public function create ($data) {
        $username = $data['username'];
        $password = $data['password'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $password = password_hash($password, PASSWORD_BCRYPT);  
        try {
            $statement = "INSERT INTO " . $this->table . "(`username`, `password`, `first_name`, `last_name`) VALUES(?,?,?,?)";
            $query = $this->conn->prepare($statement);
            $query->execute([$username, $password, $first_name, $last_name]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }

    }
}