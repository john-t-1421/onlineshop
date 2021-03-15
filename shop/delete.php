<?php
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
}
    $stmt = $pdo->prepare('DELETE FROM shop.users WHERE id = ?');
    $stmt->bindValue(1,$_SESSION['id'] , PDO::PARAM_INT);
    $stmt->execute();
    unset($_SESSION['cart'][$_SESSION['id']]);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);

    header("location: login.php"); 
    exit();
?>