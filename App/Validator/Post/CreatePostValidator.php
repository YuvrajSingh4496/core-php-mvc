<?php

namespace App\Validator\Post;

use App\Interfaces\Validator;

class CreatePostValidator implements Validator {
    static public function validate($data) {
        $validated = [
            "title" => trim($data['title']),
            "content" => trim($data['content']),
        ] ;
        $errors = [];

        if (strlen($validated['title']) < 1 || strlen($validated['title']) > 50) {
            $errors["title"] = "Title must be between 1-45 characters!";
        }

        if (strlen($validated['content']) < 1 || strlen($validated['content']) > 500) {
            $errors["title"] = "Title must be between 2-500 characters!";
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