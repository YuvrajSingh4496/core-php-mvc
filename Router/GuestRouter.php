<?php
session_start();
use App\Controllers\UserController;
use App\Classes\Session;

if (Session::user()) {
    header("location: dashboard.php");
    exit();
}

$user_model = new UserController;

if (isset($_POST['login'])) {
    $result = $user_model->authorize($_POST);
}

if (isset($_POST['register'])) {
    $result = $user_model->create($_POST);
}