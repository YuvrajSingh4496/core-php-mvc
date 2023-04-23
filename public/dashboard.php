<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";
use App\Classes\Session;
use App\Controllers\PostController;

$post_controller = new PostController;
$result = $post_controller->user_posts($_GET);

$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./includes/header.inc.php"); ?>
    <title>Dashboard</title>
</head>
<body>
    <header>
        <?php require_once("./includes/navbar.inc.php"); ?>
    </header>
    <main>
        <section id="top" class="flex flex-col text-center p-3">
            <h1 class="text-xl">
                Welcome to the dashboard <?php echo Session::user()['username']; ?>!
            </h1>
        </section>
        <section id="middle" class="flex flex-col gap-3 p-3">
            <div class="bl-2 border-green-500 ">
                <h1 class="text-md">Your posts!</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php
                if (count($result["posts"]) > 0) {
                 foreach ($result["posts"] as $post) { ?>
                    <div class="flex flex-row justify-between hover:shadow-xl rounded-md border-l-2 border-green-500 p-2">
                        <div class="flex flex-col gap-3">
                            <a href="post-view.php?post_id=<?php echo $post->id; ?>"><h1><?php echo $post->title; ?></h1></a>
                            <p class="text-slate-500"><?php echo date("D, d M, y h:i A", strtotime($post->created_at)); ?></p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <a href="post-edit.php?post_id=<?php echo $post->id; ?>" class="text-2xl text-blue-500"><i class="bi bi-pencil-square"></i></a>
                        </div>
                    </div>
                <?php } 
                } else {
                    echo "No posts found!";
                } ?>
                <div class="col-span-2">
                    <div class="flex flex-row justify-evenly">
                        <?php if ($result['pagination']['prev_page']) { ?>
                            <a href="dashboard.php?page=<?php echo $page - 1; ?>">Prev</a>
                        <?php } ?>
                        <?php if ($result['pagination']['next_page']) { ?>
                            <a href="dashboard.php?page=<?php echo $page + 1; ?>">Next</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <?php include_once "./includes/footerbar.inc.php"; ?>
    </footer>
    <?php include_once "./includes/footer.inc.php"; ?>
</body>
</html>