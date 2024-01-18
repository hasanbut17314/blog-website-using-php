<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
include "connectdb.php";
include "uniqueuser.php";
if($resultOfUnique->num_rows > 0) {
    die("The username is already taken! Please select a new username");
}
else {
    if($cpassword == $password) {
    $hashPass = password_hash($password, PASSWORD_DEFAULT); 
    $sqlInsert = "INSERT INTO blogusers(username, email, password, date) VALUES ('$username', '$email', '$hashPass', current_timestamp())" or die("Error with inserting data");
    $result = mysqli_query($conn, $sqlInsert);
    header("location: login.php");
    mysqli_close($conn);
} else {
    echo "<h3>Please enter same password <a href='signup.php'>Signup</a></h3>";
}
}
?>