<?php

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['loggedin']);
header("location: login.php");
exit;
?>