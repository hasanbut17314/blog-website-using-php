<?php
session_start();
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

include "connectdb.php";
$sql = "SELECT password, sr FROM blogusers WHERE username='$username' AND email='$email'" or die("There's an issue with database query");
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['sr'] = $row['sr'];
        header("location: welcome.php");
        mysqli_close($conn);
    }
    else{
        echo "<h3>You entered wrong password! Please try again <a href='login.php'>Login</a></h3>";
    }
}
else {
    echo "<h3>You entered wrong password or username! Please try again <a href='login.php'>Login</a></h3>";
}

?>