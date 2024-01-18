<?php
session_start();
if (isset($_POST['delete_btn'])) {
    $blogId = $_POST['blog_id'];
    $userid = $_SESSION['sr'];
    include "connectdb.php";
    $sql = "DELETE FROM blogposts WHERE blog_id = '$blogId'";
    $sqlUpdate = "UPDATE blogusers SET no_of_blogs = no_of_blogs - 1 WHERE sr = '$userid'";
    $resultUpdate = mysqli_query($conn, $sqlUpdate) or die("No. of blogs update query failed");
    $result = mysqli_query($conn, $sql) or die("Delete Query Failed");
    header("location: welcome.php");
}
?>