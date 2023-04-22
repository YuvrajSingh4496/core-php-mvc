<?php

namespace App\Validator\User;

use App\Interfaces\Validator;

class CreateUserValidator implements Validator {

    static public function validate(array $data) {
        $validated = [
            "username" => trim($data['username']),
            "password" => trim($data['password']),
            "confirm_password" => trim($data['confirm_password']),
            "first_name" => trim($data['first_name']),
            "last_name" => trim($data['last_name'])
        ] ;
        $errors = [];

        if (strlen($validated['username']) < 2 || strlen($validated['username']) > 20) {
            $errors["username"] = "Username must be between 6-20 characters!";
        }
        if (strlen($validated['password']) < 8) {
            $errors["password"] = "Password Should be more than characters!";
        }
        if ($validated["confirm_password"] != $validated["password"]) {
            $errors["confirm_password"] = "Passwords do not match!";
        }
        if (strlen($validated["first_name"]) < 2) {
            $errors["first_name"] = "First Name must be more than 2 characters!";
        }
        if (strlen($validated["last_name"]) < 2) {
            $errors["last_name"] = "Last Name must be more than 2 characters!";
        }
        if (count($errors) > 0) return ["success" => false, "data" => $errors];


        return ["success" => true, "data" => $validated];
    }
}