<?php
session_start();
use App\Classes\Session;

if (!Session::user()) {
    header("location: login.php?error=Login Required!");
    exit();
}