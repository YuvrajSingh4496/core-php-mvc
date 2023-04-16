<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";
use App\Classes\Session;
$latest_posts = $post_controller->latest_posts();
var_dump($latest_posts);
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
        <section id="middle">

        </section>
    </main>
    <footer></footer>
    <?php include_once "./includes/footer.inc.php"; ?>
</body>
</html>