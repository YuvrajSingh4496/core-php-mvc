<?php
require_once "../Middlewares/GuestMiddleware.php";
use App\Controllers\UserController;
$user_controller = new UserController;

if (isset($_POST['login'])) {
    $result = $user_controller->authorize($_POST);
}

if (isset($_POST['register'])) {
    $result = $user_controller->create($_POST);
}
