<?php

namespace App\Actions\Post;

use App\Classes\Session;
use App\Interfaces\Model;
use App\Interfaces\Action;
use App\Validator\Post\CreatePostValidator;
use Exception;

class UpdatePost implements Action {

    static public function execute($data, Model $model) {
        if ($data["user_id"] != Session::id()) {
            throw new Exception("You dont own this post!");
        }

        $validated = CreatePostValidator::validate($data);

        if (!$validated["success"]) {
            return $validated;
        }

        $validated = $validated["data"];
        $result = $model->update($validated, "id", $data["post_id"]);
        return ["success" => true, "data" => $result];
    }
}