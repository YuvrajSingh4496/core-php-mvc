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
        
        $validated[1]["password"] = password_hash($validated[1]["password"], PASSWORD_BCRYPT);

        $result = $model->create($validated[1]); 

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