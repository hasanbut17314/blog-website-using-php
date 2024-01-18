<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Blogger.com - Login</title>
</head>

 <style>
body{
    background-color: #4158D0;
    background-image: linear-gradient(267deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
}
 </style>

<body>
    <?php include "navbar.php" ?>
    <h3 class="my-3 text-center text-white">Login to see and create blogs on Blogger.com</h3>
    <div class="container my-4 w-50 shadow bg-light rounded bg-opacity-25 p-4">
        <form id="loginform" action="logincheck.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="enter username">
            </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <label for="inputPassword5" class="form-label">Password</label>
        <input type="password" name="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces,
            special characters, or emoji.
        </div>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>