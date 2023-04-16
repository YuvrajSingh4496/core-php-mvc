<?php 
require __DIR__ . "/vendor/autoload.php";
require_once "Router/UserRouter.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./Includes/header.inc.php"); ?>
    <title>Login</title>
</head>
<body>
    <header>
        <?php require_once("./Includes/navbar.inc.php"); ?>
    </header>
    <main>
        <div class="flex flex-col justify-center align-center">
            <div class="card">
                <div class="header">
                    <h1>Login</h1>
                </div>
                <div class="body">
                    <form 
                        class="flex flex-col gap-3" 
                        action="<?php $_SERVER['PHP_SELF']; ?>" 
                        method="POST"
                    >
                        <input class="text-xl" type="text" name="username" placeholder="Username..." required />
                        <input class="text-xl" type="password" name="password" placeholder="Password..." required />
                        <button 
                            class="p-3 rounded-xl border-green-500 
                                border-2 hover:bg-green-500 hover:text-white transition-all" 
                            type="submit"
                            name="login"
                        >Login</button>
                    </form> 
                </div>
            </div>
        </div>
    </main>
    <footer></footer>

</body>
</html>