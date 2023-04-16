<?php

namespace App\Actions\User;
use App\Interfaces\Action;
use App\Validator\User\CreateUserValidator;
use Models\User;

class CreateUser implements Action {

    static public function execute($data, $model) {
        $validated = CreateUserValidator::validate($data);
        if (!$validated[0]) {
            return $validated;
        }

        $result = $model->create($validated[1]); 

        if (!$result) {
            return [false, [
                "username" => "Username Already Exists!"
            ]];
        } 
        
        return [true, $result];
    }
}