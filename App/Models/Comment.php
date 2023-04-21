<?php 

namespace App\Models;

use PDOException;

class Comment extends BaseModel {
    protected string $table = "comments";
    protected array $showable = [
        "id", "comment", "created_at", "user_id", "post_id"
    ];

    protected array $fillable = [
        "comment", "user_id", "post_id"
    ];
}