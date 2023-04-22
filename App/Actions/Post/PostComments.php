<?php

namespace App\Actions\Post;

use App\Interfaces\Action;
use App\Interfaces\Model;

class PostComments implements Action {
    
    static public function execute(array $data, Model $model) {
        $post_id = $data["post_id"];

        $comments = $model->select([
            "comments.id", "comments.comment", "comments.created_at",
            "users.username" 
        ])->with("users", "user_id", "id")
            ->where("post_id", '=', $post_id)
            ->order_by("DESC", "comments.created_at")
            ->execute()->get();

        return $comments;
    }
}