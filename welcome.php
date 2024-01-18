<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <title>Blogger.com - Home</title>
</head>
<style>
    body{
        background-image: linear-gradient(270deg, #d4fc79 0%, #96e6a1 100%);
    }
    .blog-post {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-content {
            padding: 17px;
        }

        .blog-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .blog-description {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .author-name{
            font-size: 12px;
            display: flex;
            justify-content: flex-end;
        }
    
</style>
<body>
    <?php include "navbar.php" ?>
 <div class="welcome"  style="font-family: monospace; padding: 6px;">
    <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
    <p>You can find, read and write thousands of blogs on blogger.com</p>
 </div>
 
 <div class="tableOfUsers w-75 mx-auto">
    <h3 class="my-3 text-center">Our List Of Users </h3>
 <table class="table table-dark table-striped" id="myTable">
  <thead>
    <tr>
      <th scope="col">sr.no</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">No. of Blogs</th>
      <th scope="col">Joining Date</th>
    </tr>
  </thead>
  <tbody>
  <?php

include "connectdb.php";
$sql = "SELECT sr, username, email, no_of_blogs, date FROM blogusers";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
      <th scope="row"><?php echo $row['sr']; ?></th>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['no_of_blogs']; ?></td>
      <td><?php echo $row['date']; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
 </div>

<hr>

<!-- blog posting starts here -->

 <form class="container my-4" action="blog_upload.php" method="post" enctype="multipart/form-data">
  <h2 class="text-center">Post your blog</h2>
 <div class="mb-3">
  <label for="post_title" class="form-label">Post title</label>
  <input type="text" class="form-control" id="post_title" name="blogtitle" placeholder="your post title">
</div>
<div class="mb-3">
  <label for="blogdesc" class="form-label">Description</label>
  <textarea class="form-control" id="blogdesc" name="desc" placeholder="your blog description" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="post_img" class="form-label">Upload Image</label>
  <input type="file" class="form-control" id="post_img" name="blogimg">
  <p class="lead fs-6">Image should be 2mb or less</p>
 </div>
 <button type="submit" class="btn btn-primary mt-3">Upload Blog</button>
</form>
<hr>

<!-- dynamic blog starts here -->

<h2 class="text-center">Recent Blogs</h2>

<?php

$blogSql = "SELECT blog_id, blog_title, blog_desc, img_path, blog_by, date FROM blogposts";
$blogResult = mysqli_query($conn, $blogSql) or die("Failed to fetch data from table");
if(mysqli_num_rows($blogResult) > 0) {
  while($blogrow = mysqli_fetch_assoc($blogResult)) {
    $blog_id = $blogrow['blog_id'];
?>

  <div class="blog-post">
  <?php echo '<img class="blog-image" src="' . $blogrow["img_path"] . '" alt="Blog Image">'; ?>
    <div class="blog-content">
        <h2 class="blog-title"><?php echo $blogrow['blog_title']; ?></h2>
        <p class="blog-description">
        <?php echo $blogrow['blog_desc']; ?>
        </p>
        <p class="author-name">Author:&nbsp; <b><?php echo $blogrow['blog_by']; ?></b></p>
        <p class="author-name">Published on:&nbsp; <b><?php echo $blogrow['date']; ?></b></p>
    </div>
     <form action="delete.php" method="post">
      <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
      <button class="btn btn-danger mx-2 my-2" type="submit" name="delete_btn">Delete</button>
     </form>
       <a href="updateblog.php?index=<?php echo $blog_id; ?>" class="btn btn-warning my-2 mx-3">
          Edit
  </a>
       
</div>

<?php } } else {echo "No Blogs Found!";} ?>
 <script>
  let table = new DataTable('#myTable');
 </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>


</body>
</html>