<?php

namespace App\Validator\Comment;

use App\Interfaces\Validator;

class CreateCommentValidator implements Validator {

    static public function validate(array $data) {
        $validated = [
            "comment" => trim($data['comment']),
            "post_id" => trim($data['post_id']),
        ];
        $errors = [];

        if (strlen($validated['comment']) < 1 || strlen($validated['comment']) > 1000) {
            $errors["comment"] = "Comment must be between 1-1000 characters!";
        }

        if (strlen($validated['post_id']) < 1 || $validated["post_id"] == '') {
            $errors["post_id"] = "Post id is required!";
        }

        if (count($errors) > 0) return [
            "success" => false, 
            "data" => $errors
        ];
        
        return [
            "success" => true, 
            "data" => $validated
        ];
    }
}