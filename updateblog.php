<?php
include "navbar.php";
$blogId = $_GET['index'];

include "connectdb.php";
$query = "SELECT * FROM blogposts WHERE blog_id = '$blogId'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $blogTitle = $row['blog_title'];
    $blogDesc = $row['blog_desc'];
    $blogImg = $row['img_path'] ;

    $result->close();
    ?>
<form class="container my-4" action="updatesave.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <input type="hidden" name="blog_id" value="<?php echo $blogId; ?>">
            <label for="post_title" class="form-label">Post title</label>
            <input type="text" class="form-control" id="post_title" name="blogtitle" placeholder="your post title" value="<?php echo $blogTitle; ?>">
          </div>
          <div class="mb-3">
            <label for="blogdesc" class="form-label">Description</label>
            <textarea class="form-control" id="blogdesc" name="desc" placeholder="your blog description" rows="3"><?php echo $blogDesc; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="post_img" class="form-label">Update Image</label>
            <input type="file" class="form-control" id="post_img" name="blogimg">
            <p class="lead fs-6">Image should be 2mb or less</p>
          </div>
          <div class="modal-footer">
            <a href="welcome.php" class="btn btn-secondary mx-2">Cancel</a>
            <button type="submit" name="update_btn" class="btn btn-primary mx-2">Update Blog</button>
          </div>
        </form>
        <?php } else {echo "selection query failed, did'nt get the blogID";} ?>