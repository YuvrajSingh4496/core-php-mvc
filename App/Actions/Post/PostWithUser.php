<?php

namespace App\Actions\Post;

use App\Interfaces\Action;
use App\Interfaces\Model;

class PostWithUser implements Action {
    
    static public function execute(array $data, Model $model) {
        $post  = $model->select([
            "posts.id", "posts.title", "posts.content", "posts.created_at", "users.username"
        ])->with("users", "user_id", "id")
        ->where("id", '=', $data["post_id"])
        ->execute()->first();

        return $post;
    }
}