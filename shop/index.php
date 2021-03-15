<?php

session_start();
if(! (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) ){
    header("location: login.php");
    exit;
}
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';
?>
