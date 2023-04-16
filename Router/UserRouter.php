<?php

use App\Controllers\UserController;
$user_model = new UserController;

if (isset($_POST['login'])) {
    $result = $user_model->authorize($_POST);
}

if (isset($_POST['register'])) {
    $result = $user_model->create($_POST);
}