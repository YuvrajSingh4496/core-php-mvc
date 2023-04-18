<?php

namespace App\Controllers;

use App\Actions\Post\CreatePost;
use App\Interfaces\Controller;
use App\Classes\Session;
use App\Models\Post;
use App\Classes\Helper;

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
            "pagination" => Helper::paginator($page, $count)
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
            "pagination" => Helper::paginator($page, $count)
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
        return;
    }
}