<?php

namespace App\Controllers;

use App\Actions\Post\CreatePost;
use App\Interfaces\Controller;
use App\Models\Post;
use App\Services\PostService;
use App\Actions\Post\UpdatePost;
use Exception;

class PostController implements Controller {

    protected $model;
    protected $service;

    public function __construct() {
        $this->model = new Post;
        $this->service = new PostService;
    }

    public function index(array $request) {
        $result = $this->service->index($request, $this->model);
        return $result;
    }

    public function user_posts(array $request) {
        $result = $this->service->all_user_posts($request, $this->model);
        return $result;
    }

    public function create(array $request) {
        $action = CreatePost::execute($request, $this->model);
        if (!$action["success"]) {
            return $action["data"];
        }

        header("location: post-create.php?message=Post Created Successfully!");
        exit();
    }

    public function update(array $request) {
        try {
            $action = UpdatePost::execute($request, $this->model);
            if (!$action["success"]) {
                return $action["data"];
            }
    
            header("location: post-view.php?post_id=". $request["post_id"] ."&message=Post Updated Successfully!");
            exit();
        } catch (Exception $e) {
            dd($e);
        }
    }
    
    public function show($request) {
        try {
            $result = $this->service->show_post($request, $this->model);
            return $result;
        } catch (\Exception $e) {
            // print_r($e);
            header("location: post-index.php?error=An Error Occured!");
            exit();
        }
    }
}