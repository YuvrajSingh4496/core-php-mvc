<?php 

namespace App\Models;

use PDOException;

class User extends BaseModel {
    protected string $table = "comments";
    protected array $showable = [
        "id", "comment", "created_at", "user"
    ];

    protected array $fillable = [
        "username", "password", "first_name", "last_name"
    ];

}