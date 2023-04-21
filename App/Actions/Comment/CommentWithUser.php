<?php

namespace App\Actions\Comment;

use App\Interfaces\Action;
use App\Interfaces\Model;

class CommentWithUser implements Action {
    
    static public function execute(array $data, Model $model) {
        $post_id = $data["post_id"];

        $comments = $model->select([
            "posts.title", "posts.content", "posts.created_at", "users.username"
        ])->with("users", "user_id", "id")
        ->where("id", '=', $data["post_id"])
        ->execute()->first();

        return $post;
    }
}