<?php

namespace App\Actions\Post;

use App\Classes\Session;
use App\Interfaces\Model;
use App\Interfaces\Action;
use App\Validator\Post\CreatePostValidator;

class CreatePost implements Action {

    static public function execute($data, Model $model) {
        $validated = CreatePostValidator::validate($data);

        if (!$validated["success"]) {
            return $validated;
        }
        
        $result = $model->create([
            "title" => $validated["title"],
            "content" => $validated["content"],
            "user_id" => Session::id(),
        ]);
        return ["success" => true, "data" => $result];
    }
}