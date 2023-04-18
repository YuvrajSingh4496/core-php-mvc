<?php

namespace App\Actions\User;

use App\Classes\Session;
use App\Interfaces\Action;
use App\Validator\User\AuthorizeUserValidator;

class AuthorizeUser implements Action {

    static public function execute($data, $model) {
        $validated = AuthorizeUserValidator::validate($data);
        if (!$validated["success"]) {
            return $validated;
        }

        $user = $model->select(['*'])
                    ->where("username", '=', $validated[1]['username'])
                    ->execute()
                    ->first();

        if (!$user) {
            return [
                "success" => false, 
                "data" => [
                "username" => "Incorrect Username or Password!"
                ]
            ];
        }

        // checking password
        if (!password_verify($validated[1]['password'], $user->password)) {
            return [
                "success" => false, 
                "data" => [
                "username" => "Incorrect Username or Password!"
                ]
            ];
        }

        Session::set("user", [
            "id" => $user->id,
            "username" => $user->username,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name
        ]);

        return ["success" => true, "data" => Session::user()];
    }
}