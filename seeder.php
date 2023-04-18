<?php 
require_once __DIR__."./vendor/autoload.php";
use App\Models\Post;

function seed() {
    $post_model = new Post;
    for ($i = 0; $i < 20; $i++) {
        $post_model->create([
            "title" => "title" . $i,
            "content" => "this is comtnet",
            "user_id" => 8
        ]);
        echo "Seeded: $i <br>"; 
    }
}


seed();
