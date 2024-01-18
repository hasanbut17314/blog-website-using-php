<?php
session_start();
if(isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
}
else{
    echo "<h3>In order to logout! You need to login first. <a href='login.php'>Login</a></h3>";
}
?>