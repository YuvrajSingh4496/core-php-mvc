<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";
use App\Classes\Session;
use App\Controllers\PostController;

$post_controller = new PostController;
$result = $post_controller->show($_GET);
$post = $result["post"];
$comments = $result["comments"];
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
        <section id="comments" class="flex flex-col p-3">
            <h1 class="text-center">Comments</h1>
            <div class="p-3">
                <?php 
                if (count($comments) > 0) {
                    foreach ($comments as $comment) { ?>
                    <div class="flex flex-col p-2">
                        <h1>
                            <?php echo $comment->username; ?> 
                            <small class="text-slate-500">on <?php echo format_date($comment->created_at); ?></small>
                        </h1>
                        <p><?php echo $comment->comment; ?></p>
                    </div>
                <?php }
                } else {
                    echo "<h1>No comments!</h1>";
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
        <?php include_once "./includes/footerbar.inc.php"; ?>
    </footer>
    <?php include_once "./includes/footer.inc.php"; ?>
</body>
</html>