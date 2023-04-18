<?php
namespace App\Classes;

class Helper {
    static public function paginator($page, $total, $limit = 10) {
        $links = [
            "prev_page" => true,
            "next_page" => true 
        ];

        if ($page > ($total / $limit)) {
            $links["next_page"] = false;
        }

        if ($page <= 1) {
            $links["prev_page"] = false;
        }

        return $links;
    }
}