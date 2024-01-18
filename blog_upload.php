<?php
session_start();
if(isset($_SESSION['username'])) {
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogtitle = $_POST['blogtitle'];
    $blogdesc = $_POST['desc'];
    $author = $_SESSION['username'];
    $userid = $_SESSION['sr'];

    //inserting image in folder
    $targetFolder = "userblogimg/";
    $image_name = $_FILES['blogimg']['name'];
    $image_tmp_name = $_FILES['blogimg']['tmp_name'];
    $image_type = $_FILES['blogimg']['type'];
    $image_error = $_FILES['blogimg']['error'];
    $image_size = $_FILES['blogimg']['size'];
    if ($image_error === UPLOAD_ERR_OK && in_array($image_type, array('image/jpeg', 'image/png', 'image/jpg'))) {
        $maxFileSize = 2 * 1024 * 1024;
        if($image_size <= $maxFileSize ) {
            $destination = $targetFolder . $image_name;
        if (move_uploaded_file($image_tmp_name, $destination)) {
            include "connectdb.php";
            $sql = "INSERT INTO blogposts(blog_title, blog_desc, img_path, blog_by) VALUES ('$blogtitle', '$blogdesc', '$destination', '$author')";
            $sqlUpdate = "UPDATE blogusers SET no_of_blogs = no_of_blogs + 1 WHERE sr = '$userid'";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            $result = mysqli_query($conn, $sql) or die("Database Insert query failed!");
            mysqli_close($conn);
            header("location: welcome.php");
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: You cannot upload more than 2mb image";
    }
    }
    else {
        echo "Error: Only JPG, PNG, and GIF files are allowed.";
        exit();

    }

}


}
else {
    echo '<h3>You need to login first <a href="login.php">Login here</a></h3>';
}

?>