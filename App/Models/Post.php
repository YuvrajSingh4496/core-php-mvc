<?php

namespace App\Models;
use App\Models\BaseModel;
use PDO;
use PDOException;

class Post extends BaseModel {
    protected string $table = "posts";
    protected array $showable = [
        "id", "title", "content", "created_at", "user_id"
    ];
    protected array $fillable = [
        "title", "content", "user_id"
    ];


    public function get_latest_posts($limit = 10, $start = 0) {
        $end = ($limit + $start);
        $statement = "SELECT * FROM ". $this->table ." ORDER BY `created_at` DESC LIMIT :start, :end";
        $query = $this->conn->prepare($statement);
        $query->bindParam(":start", $start, PDO::PARAM_INT);
        $query->bindParam(":end", $end, PDO::PARAM_INT);
        $query->execute();
        $this->result = $query->fetchAll();
        return $this;
    }
}