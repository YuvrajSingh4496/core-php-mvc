<?php

namespace App\Actions\Post;

use App\Interfaces\Action;
use App\Interfaces\Model;

class PostComments implements Action {
    
    static public function execute(array $data, Model $model) {
        $post_id = $data["post_id"];

        $comments = $model->select(['*'])
        ->with("users", "user_id", "id")
        ->where("post_id", '=', $post_id)
        ->execute()->get();

        return $comments;
    }
}