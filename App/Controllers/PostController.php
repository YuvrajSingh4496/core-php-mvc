<?php

namespace App\Controllers;

use App\Interfaces\Controller;
use App\Models\Post;

class PostController implements Controller {

    protected $model;

    public function __construct() {
        $this->model = new Post;
    }

    public function latest_posts() {
        $result = $this->model->get_latest_posts(10);
        return $result->get();
    }

    public function create($request) {
        
    }

    public function show($request) {
        return;
    }
}