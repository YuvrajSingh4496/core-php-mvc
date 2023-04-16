<?php 

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "oop";

    public function connect () {
        $dns = "mysql:host=" . $this->host . ";dbname=" . $this->database;
        try {
            $connection = new PDO($dns, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            return $connection;
        } catch (PDOException $e) {
            die("Dead. 💀");
        }
    }
}