<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";
use App\Classes\Session;
use App\Controllers\PostController;

use function App\Classes\format_date;

$post_controller = new PostController;
$result = $post_controller->show($_GET);
$post = $result["post"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./includes/header.inc.php"); ?>
    <title>Show post</title>
</head>
<body>
    <header>
        <?php require_once("./includes/navbar.inc.php"); ?>
    </header>
    <main>
        <section id="top" class="flex flex-col text-center p-3">
            <h1 class="text-xl">
                <?php echo $post->title; ?> <br>
                <small class="text-slate-500">on <?php echo format_date($post->created_at);?></small>
            </h1>
        </section>
        <section id="middle" class="flex flex-col gap-3 p-3">
            <div class="p-5">
                <p><?php echo $post->content; ?></p>
            </div>
            <div class="p-5">
                <p>Created By: <?php echo $post->username; ?></p>
            </div>
        </section>
    </main>
    <footer>
        <?php include_once "./includes/footerbar.inc.php"; ?>
    </footer>
    <?php include_once "./includes/footer.inc.php"; ?>
</body>
</html>