<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";

use App\Classes\Session;
use App\Controllers\PostController;
$post_controller = new PostController;
$result = $post_controller->show($_GET);
$post = $result["post"];

if ($post->user_id != Session::id()) {
    header("location: dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./includes/header.inc.php"); ?>
    <title>Edit post</title>
</head>
<body>
    <header>
        <?php require_once("./includes/navbar.inc.php"); ?>
    </header>
    <main>
        <div class="flex flex-col justify-center align-center">
            <div class="card">
                <div class="header">
                    <h1>Edit Post</h1>
                </div>
                <div class="body">
                    <form 
                        id="create-post-form"
                        class="flex flex-col gap-3" 
                        action="<?php $_SERVER['PHP_SELF']; ?>" 
                        method="POST"
                    >

                    <div class="flex flex-col gap-2">
                        <input type="text" name="post_id" value="<?php echo $post->id ?>" hidden />
                        <input type="text" name="user_id" value="<?php echo $post->user_id ?>" hidden />
                        <input
                            value="<?php echo $post->title; ?>" 
                            class="text-xl" type="text" name="title" placeholder="Title..." required />
                        <?php if (isset($result['title'])) {?>
                            <small class="text-red-500"><?php echo $result['title']; ?></small>
                        <?php } ?>
                    </div>
                    <div class="flex flex-col gap-2">
                        <textarea name="content" id="create-post-form-textarea" required><?php echo $post->content; ?></textarea>
                        <!-- <div id="form-textarea"></div> -->
                        <?php if (isset($result['content'])) {?>
                            <small class="text-red-500"><?php echo $result['content']; ?></small>
                        <?php } ?>
                        </div>
                    <button 
                        class="p-3 rounded-xl border-green-500 
                            border-2 hover:bg-green-500 hover:text-white transition-all" 
                        type="submit"
                        name="update-post"
                    >Create</button>
                    </form> 
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include_once "./includes/footerbar.inc.php"; ?>
    </footer>
    <?php include_once "./includes/footer.inc.php"; ?>
</body>
</html>