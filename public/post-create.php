<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("./includes/header.inc.php"); ?>
    <title>Create new post</title>
</head>
<body>
    <header>
        <?php require_once("./includes/navbar.inc.php"); ?>
    </header>
    <main>
        <div class="flex flex-col justify-center align-center">
            <div class="card">
                <div class="header">
                    <h1>Create Post</h1>
                </div>
                <div class="body">
                    <form 
                        class="flex flex-col gap-3" 
                        action="<?php $_SERVER['PHP_SELF']; ?>" 
                        method="POST"
                    >

                    <div class="flex flex-col gap-2">
                        <input class="text-xl" type="text" name="title" placeholder="Title..." required />
                        <?php if (isset($result['title'])) {?>
                            <small class="text-red-500"><?php echo $result['title']; ?></small>
                        <?php } ?>
                    </div>
                    <div class="flex flex-col gap-2">
                        <textarea  id="form-textarea" name="content" placeholder="Content..." required></textarea>
                        <?php if (isset($result['content'])) {?>
                            <small class="text-red-500"><?php echo $result['content']; ?></small>
                        <?php } ?>
                        </div>
                    <button 
                        class="p-3 rounded-xl border-green-500 
                            border-2 hover:bg-green-500 hover:text-white transition-all" 
                        type="submit"
                        name="create-post"
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