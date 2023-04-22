<?php

namespace App\Validator\User;

use App\Interfaces\Validator;

class AuthorizeUserValidator implements Validator {

    static public function validate(array $data) {
        $validated = [
            "username" => trim($data['username']),
            "password" => trim($data['password']),
        ];
        $errors = [];

        if (strlen($validated['username']) < 2 || strlen($validated['username']) > 20) {
            $errors["username"] = "Username must be between 6-20 characters!";
        }
        if (strlen($validated['password']) < 8) {
            $errors["password"] = "Password Should be more than 8 characters!";
        }
        
        if (count($errors) > 0) return ["success" => false, "data" => $errors];

        return ["success" => true, "data" => $validated];
    }
}