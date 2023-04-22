<?php

namespace App\Actions\Comment;

use App\Classes\Session;
use App\Interfaces\Model;
use App\Interfaces\Action;

class CreateComment implements Action {

    static public function execute(array $data, Model $model) {
        $result = $model->create($data);
        return ["success" => true, "data" => $result];
    }
}