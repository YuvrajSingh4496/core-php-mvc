<?php 

namespace App\Services;

use App\Classes\Session;
use App\Interfaces\Model;
use App\Interfaces\Service;
use App\Actions\Post\PostWithUser;

class PostService implements Service {

    public function index(array $request, Model $model): array {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
                    
        $result = $model->select()
                    ->limit(10, $start)
                    ->execute()->get();

        $count = $model->count()->execute()->first()->count;
        return [
            "posts" => $result,
            "count" => $count,
            "pagination" => paginator($page, $count)
        ];
    }

    public function show(int $post_id, Model $model): array {
        $post = PostWithUser::execute(["post_id" => $post_id], $model);
        $comment = new Comment;
        $comments = 
        return [
            "post" => $post
        ];
    }

    public function all_user_posts(array $request, Model $model): array {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
        $user_id = Session::user()['id'];
        $result = $model->select()
                    ->where("user_id", '=', $user_id)
                    ->limit(10, $start)
                    ->execute()->get();

        $count = $model->count()
                    ->where("id", '=', $user_id)
                    ->execute()->first()->count;

        return [
            "posts" => $result,
            "count" => $count,
            "pagination" => paginator($page, $count)
        ];
    }
}