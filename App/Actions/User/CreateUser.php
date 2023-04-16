<?php

namespace App\Actions\User;
use App\Interfaces\Action;
use Models\User;

class CreateUser implements Action {

    static public function execute($data, $model) {
        $username = trim($data['username']);
        $password = trim($data['password']);
        $first_name = trim($data['first_name']);
        $last_name = trim($data['last_name']);
        $errors = [];

        if (strlen($username) < 2 || strlen($username) > 20) {
            $errors["username"] = "Username must be between 6-20 characters!";
        }
        if (strlen($password) < 8) {
            $errors["password"] = "Password Should be more than characters!";
        }
        if (strlen($first_name) < 2) {
            $errors["first_name"] = "First Name must be more than 2 characters!";
        }
        if (strlen($last_name) < 2) {
            $errors["last_name"] = "First Name must be more than 2 characters!";
        }
        if (count($errors) > 0) return [false, $errors];

        $result = $model->create([
            "username" => $username,
            "password" => $password,
            "first_name" => $first_name,
            "last_name" => $last_name
        ]); 

        if (!$result) {
            $errors["username"] = "Username Already Exists!";
            return [false, $errors];
        } 
        
        return [true, $result];
    }
}