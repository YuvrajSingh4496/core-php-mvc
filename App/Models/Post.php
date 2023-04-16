<?php

namespace App\Models;
use App\Models\BaseModel;
use PDO;

class Post extends BaseModel {
    protected $table = "posts";

    public function get_latest_posts($limit = 10) {
        $statement = "SELECT * FROM ". $this->table ." ORDER BY `created_at` DESC LIMIT :limit";
        $query = $this->conn->prepare($statement);
        $query->bindParam(":limit", $limit, PDO::PARAM_INT);
        $this->result = $query->fetchAll();
        return $this;
    }
}