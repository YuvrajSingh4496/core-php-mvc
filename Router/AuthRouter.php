<?php
require_once "../Middlewares/AuthMiddleware.php";
use App\Controllers\UserController;
use App\Controllers\PostController;
use App\Controllers\CommentController;

// Create a new post
if (isset($_POST["create-post"])) {
    $request = filter_request("POST"); 
    $post_controller = new PostController;
    $result = $post_controller->create($request);
}


// Create a comment
if (isset($_POST["create-comment"])) {  
    $request = filter_request("POST"); 
    $comment_controller = new CommentController;
    $result = $comment_controller->create($request);
}