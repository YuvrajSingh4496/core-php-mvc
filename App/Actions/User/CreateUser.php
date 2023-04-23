<?php

namespace App\Actions\User;
use App\Interfaces\Action;
use App\Validator\User\CreateUserValidator;
use Models\User;

class CreateUser implements Action {

    static public function execute($data, $model) {
        $validated = CreateUserValidator::validate($data);

        if (!$validated["success"]) {
            return $validated;
        }
        
        $validated = $validated["data"];
        $validated["password"] = password_hash($validated["password"], PASSWORD_BCRYPT);

        $result = $model->create($validated); 

        if (!$result) {
            return [
                "success" => false, 
                "data" => [
                   "username" => "Username Already Exists!"
                ]
            ];
        } 
        
        return ["success" => true, "data" => $result];
    }
}