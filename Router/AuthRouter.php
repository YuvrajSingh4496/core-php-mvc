<?php
require_once "../Middlewares/AuthMiddleware.php";
use App\Controllers\UserController;
use App\Controllers\PostController;


// Create a new post
if (isset($_POST['create-post'])) {
    $post_controller = new PostController;
    $result = $post_controller->create($_POST);
}