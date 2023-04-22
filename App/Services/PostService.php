<?php 

namespace App\Services;

use App\Actions\Post\PostComments;
use App\Classes\Session;
use App\Interfaces\Model;
use App\Interfaces\Service;
use App\Actions\Post\PostWithUser;
use App\Models\Comment;

class PostService implements Service {

    public function index(array $request, Model $model): array {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
                    
        $result = $model->select()
                    ->order_by("DESC", "created_at")
                    ->limit(10, $start)
                    ->execute()->get();

        $count = $model->count()->execute()->first()->count;
        return [
            "posts" => $result,
            "count" => $count,
            "pagination" => paginator($page, $count)
        ];
    }

    public function show_post(array $request, Model $model): array {
        $post_id = $request["post_id"];
        $post = PostWithUser::execute(["post_id" => $post_id], $model);
        $comments = PostComments::execute(["post_id" => $post_id], (new Comment));
        return [
            "post" => $post,
            "comments" => $comments
        ];
    }

    public function all_user_posts(array $request, Model $model): array {
        $page = isset($request['page']) ? (int)$request["page"] : 1;
        $start = ($page - 1) * 10;
        $user_id = Session::user()['id'];
        $result = $model->select()
                    ->where("user_id", '=', $user_id)
                    ->order_by("DESC", "created_at")
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