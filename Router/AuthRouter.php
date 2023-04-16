<?php
require_once "../Middlewares/AuthMiddleware.php";
use App\Controllers\UserController;
use App\Controllers\PostController;

$user_controller = new UserController;
$post_controller = new PostController;
