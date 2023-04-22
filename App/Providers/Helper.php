<?php
function paginator($page, $total, $limit = 10) {
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

function format_date(string $date) {
    return date("D, d M, y h:i A", strtotime($date));
}

function dd(...$args) {
    $i = 0;
    echo "<pre>";
    foreach ($args as $arg) {
        echo $i. ": ";
        print_r($arg);
        echo "<br>";
    }
    echo "</pre>";
}