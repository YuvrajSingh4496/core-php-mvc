<?php 
require_once "./includes/message.inc.php"; 
use App\Classes\Session;
?>

<nav>
    <div class="flex flex-col md:flex-row gap-5 items-center justify-center p-5">
        <h1 class="text-2xl">Php Core MVC</h1>
        <div class="flex flex-row justify-evenly gap-2">
            <?php if (!Session::user()) { ?>
                <a href="login.php" class="hover:text-green-500">Login</a>
                <a href="register.php" class="hover:text-green-500">Sign Up</a>
            <?php } else { ?>
                <a href="dashboard.php" class="hover:text-green-500">Dashboard</a>
                <a href="post-index.php" class="hover:text-green-500">Posts</a>
                <a href="post-create.php" class="hover:text-green-500">Create post</a>
                <a href="logout.php" class="hover:text-green-500">Logout</a>
            <?php } ?>
        </div>
    </div>
</nav>

