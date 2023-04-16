<?php
session_start();
use App\Classes\Session;

if (Session::user()) {
    header("location: dashboard.php");
    exit();
}