<?php
include "connectdb.php";

if (isset($_POST['update_btn'])) {
    $blogId = $_POST['blog_id'];
    $newBlogTitle = $_POST['blogtitle'];
    $newBlogDesc = $_POST['desc'];
    $targetFolder = "userblogimg/";
    $image_name = $_FILES['blogimg']['name'];
    $image_tmp_name = $_FILES['blogimg']['tmp_name'];
    $image_type = $_FILES['blogimg']['type'];
    $image_error = $_FILES['blogimg']['error'];
    $image_size = $_FILES['blogimg']['size'];
    if(empty($_FILES['blogimg']['name'])){
    $updateQuery = "UPDATE blogposts SET blog_title = '$newBlogTitle', blog_desc = '$newBlogDesc' WHERE blog_id = $blogId";
    $updateResult = mysqli_query($conn, $updateQuery);
    header("location: welcome.php");
    mysqli_close($conn);
    die;
    }
    else{

        include "connectdb.php";
    if ($image_error === UPLOAD_ERR_OK && in_array($image_type, array('image/jpeg', 'image/png', 'image/jpg'))) {
        $maxFileSize = 2 * 1024 * 1024;
        if($image_size <= $maxFileSize ) {
            $destination = $targetFolder . $image_name;
        if (move_uploaded_file($image_tmp_name, $destination)) {
             $ImgupdateQuery = "UPDATE blogposts SET blog_title = '$newBlogTitle', blog_desc = '$newBlogDesc', img_path = '$destination' WHERE blog_id = $blogId";
             $ImgupdateResult = mysqli_query($conn, $ImgupdateQuery);
             header("location: welcome.php");
             mysqli_close($conn);
        }
        else {
            echo "image upload failed!";
        }
    }
    else {
        echo "Please Upload 2mb or less image";
    }

} else{
    echo "Error uplaoding Image! please select jpeg, png and jpg images";
} }
}

?>