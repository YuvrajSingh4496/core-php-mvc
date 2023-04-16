<?php

namespace App\Controllers;

use App\Actions\User\CreateUser;
use App\Interfaces\Controller;
use App\Models\User;

class UserController implements Controller {

    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function authorize($request) {
        return;
    }
    
    public function create($request) {
        $response = CreateUser::execute($request, $this->model);
        if ($response[0] == false) {
            return $response[1];
        }

        header("location: login.php?message=User Registered Successfully!");
        exit();
    }

    public function update($request) {
        return;
    }
    public function index($request) {
        return;
    }
}