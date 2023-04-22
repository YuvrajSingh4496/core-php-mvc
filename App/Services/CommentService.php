<?php 

namespace App\Services;

use App\Interfaces\Model;
use App\Interfaces\Service;
use App\Classes\Session;
use App\Validator\Comment\CreateCommentValidator;

class CommentService implements Service {

    public function create_comment(array $request, Model $model) {
        $validated = CreateCommentValidator::validate($request);
        if (!$validated["success"]) {
            return $validated;
        }      
        
        $validated = $validated["data"];
        $result = $model->create([
            "comment" => $validated["comment"],
            "post_id" => $validated["post_id"],
            "user_id" => Session::id()
        ]);
        return ["success" => true, "data" => $result];
    }

}