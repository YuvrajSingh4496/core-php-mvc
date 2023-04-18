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
        $action = AuthorizeUser::execute($request, $this->model);
        if (!$action["success"]) {
            return $action["data"];
        }
        
        header("location: dashboard.php?message=Login Successfull!");
        exit();
    }
    
    public function create($request) {
        $action = CreateUser::execute($request, $this->model);
        if (!$action["success"]) {
            return $action["data"];
        }

        header("location: login.php?message=User Registered Successfully!");
        exit();
    }

    public function show($request) {
        return;
    }
}