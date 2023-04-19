<?php

namespace App\Controllers;

use App\Actions\Post\CreatePost;
use App\Interfaces\Controller;
use App\Classes\Session;
use App\Models\Post;

class PostController implements Controller {

    protected $model;

    public function __construct() {
        $this->model = new Post;
    }

    public function index($request) {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
                    
        $result = $this->model->select()
                    ->limit(10, $start)
                    ->execute()->get();

        $count = $this->model->count()->execute()->first()->count;
        return [
            "posts" => $result,
            "count" => $count,
            "pagination" => paginator($page, $count)
        ];
    }

    public function user_posts($request) {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
        $user_id = Session::user()['id'];
        $result = $this->model->select()
                    ->where("user_id", '=', $user_id)
                    ->limit(10, $start)
                    ->execute()->get();

        $count = $this->model->count()
                    ->where("id", '=', $user_id)
                    ->execute()->first()->count;

        return [
            "posts" => $result,
            "count" => $count,
            "pagination" => paginator($page, $count)
        ];
    }

    public function create($request) {
        $action = CreatePost::execute($request, $this->model);
        if (!$action["success"]) {
            return $action["data"];
        }

        header("location: post-create.php?message=Post Created Successfully!");
        exit();
    }

    public function show($request) {
        $post_id = $request["post_id"];
        $post  = $this->model->select([
                    "posts.title", "posts.content", "posts.created_at", "users.username"
                ])->with("users", "user_id", "id")
                ->where("id", '=', $post_id)
                ->execute()->first();
                // print_r($post);
        return [
            "post" => $post
        ];
    }
}