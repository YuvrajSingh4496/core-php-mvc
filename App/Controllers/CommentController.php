<?php

namespace App\Controllers;

use App\Interfaces\Controller;
use App\Interfaces\Model;
use App\Interfaces\Service;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController implements Controller {
   
    protected Service $service;
    protected Model $model;

    public function __construct() {
        $this->model = new Comment;   
        $this->service = new CommentService;   
    }

    public function create(array $request) {
        $result = $this->service->create_comment($request, $this->model);
        if (!$result["success"]) {
            return $result["data"];
        }

        // header("location: post-view.php?post_id  
    }
}