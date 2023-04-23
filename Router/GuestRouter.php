<?php
require_once "../Middlewares/GuestMiddleware.php";
use App\Controllers\UserController;
$user_controller = new UserController;

if (isset($_POST['login'])) {
    $request = filter_request("POST"); 
    $result = $user_controller->authorize($request);
}

if (isset($_POST['register'])) {
    $request = filter_request("POST"); 
    $result = $user_controller->create($request);
}
