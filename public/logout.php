<?php 
require __DIR__ . "/../vendor/autoload.php";
require_once "../Router/AuthRouter.php";

use App\Classes\Session;

Session::destory();

header("location: login.php?message=Logged out successfully!");
exit();