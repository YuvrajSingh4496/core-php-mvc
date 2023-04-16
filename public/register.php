<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/GuestRouter.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./includes/header.inc.php"); ?>
    <title>Register</title>
</head>
<body>
    <header>
        <?php require_once("./includes/navbar.inc.php"); ?>
    </header>
    <main>
        <div class="flex flex-col justify-center align-center">
            <div class="card">
                <div class="header">
                    <h1>Register</h1>
                </div>
                <div class="body">
                    <form 
                        class="flex flex-col gap-3" 
                        action="<?php $_SERVER['PHP_SELF']; ?>" 
                        method="POST"
                    >
                    <div class="flex flex-row justify-evenly gap-3">
                        <div class="flex flex-col gap-2">
                            <input class="text-xl" type="text" name="first_name" placeholder="First Name..." required />
                            <?php if (isset($result['first_name'])) {?>
                                <small class="text-red-500"><?php echo $result['first_name']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="flex flex-col gap-2">
                            <input class="text-xl" type="text" name="last_name" placeholder="Last Name..." required />
                            <?php if (isset($result['last_name'])) {?>
                                <small class="text-red-500"><?php echo $result['last_name']; ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <input class="text-xl" type="text" name="username" placeholder="Username..." required />
                    <?php if (isset($result['username'])) {?>
                        <small class="text-red-500"><?php echo $result['username']; ?></small>
                    <?php } ?>
                    <input class="text-xl" type="password" name="password" placeholder="Password..." required />
                    <?php if (isset($result['password'])) {?>
                        <small class="text-red-500"><?php echo $result['password']; ?></small>
                    <?php } ?>
                    <input class="text-xl" type="password" name="confirm_password" placeholder="Confirm Password..." required />
                    <?php if (isset($result['confirm_password'])) {?>
                        <small class="text-red-500"><?php echo $result['confirm_password']; ?></small>
                    <?php } ?>
                    <button 
                        class="p-3 rounded-xl border-green-500 
                            border-2 hover:bg-green-500 hover:text-white transition-all" 
                        type="submit"
                        name="register"
                    >Register</button>
                    </form> 
                </div>
            </div>
        </div>
    </main>
    <footer></footer>

</body>
</html>