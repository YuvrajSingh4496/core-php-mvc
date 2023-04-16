<?php

namespace App\Actions\User;

use App\Classes\Session;
use App\Interfaces\Action;
use App\Validator\User\AuthorizeUserValidator;

class AuthorizeUser implements Action {

    static public function execute($data, $model) {
        $validated = AuthorizeUserValidator::validate($data);
        if (!$validated[0]) {
            return $validated;
        }

        $user = $model->where("username", '=', $validated[1]['username'])->first();
        if (!$user) {
            return [false, [
                "username" => "Incorrect Username or Password!"
            ]];
        }

        // checking password
        if (!password_verify($validated[1]['password'], $user->password)) {
            return [false, [
                "username" => "Incorrect Username or Password!"
            ]];

        }

        Session::set("user", [
            "id" => $user->id,
            "username" => $user->username,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name
        ]);

        return [true, Session::user()];
    }
}