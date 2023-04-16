<?php

namespace App\Controllers;

use App\Actions\User\AuthorizeUser;
use App\Actions\User\CreateUser;
use App\Interfaces\Controller;
use App\Models\User;

class UserController implements Controller {

    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function authorize($request) {
        $response = AuthorizeUser::execute($request, $this->model);
        if (!$response[0]) {
            return $response[1];
        }
        
        header("location: dashboard.php?message=Login Successfull!");
        exit();
    }
    
    public function create($request) {
        $response = CreateUser::execute($request, $this->model);
        if ($response[0] == false) {
            return $response[1];
        }

        header("location: login.php?message=User Registered Successfully!");
        exit();
    }

    public function show($request) {
        return;
    }
}