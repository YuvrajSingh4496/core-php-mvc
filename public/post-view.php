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
                <p><?php
                    echo htmlspecialchars_decode(stripslashes($post->content));
                    // echo strip_tags($post->content, ALLOWED_TAGS);
                    // echo $post->content; 
                ?></p>
            </div>
            <div class="p-5">
                <p>Created By: <?php echo $post->username; ?></p>
            </div>
        </section>
        <section id="comments" class="flex flex-col p-3 gap-5">
            <h1 class="text-center">Comments</h1>
            <form 
                action="<?php $_SERVER["PHP_SELF"]; ?>"
                method="POST"
                class="flex flex-row gap-3">
                <input class="w-full p-2 rounded-lg border-2" type="text" name="comment" placeholder="Write a comment..." />
                <?php if (isset($result['comment'])) {?>
                    <small class="text-red-500"><?php echo $result['comment']; ?></small>
                <?php } ?>
                <input type="text" name="post_id" value="<?php echo $post->id; ?>" hidden />
                <?php if (isset($result['post_id'])) {?>
                    <small class="text-red-500"><?php echo $result['post_id']; ?></small>
                <?php } ?>
                <button
                    name="create-comment"
                    type="submit" 
                    class="border-green-500 hover:bg-green-500 border-2 border-green-400 rounded-xl">Comment</button>
            </form>
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
