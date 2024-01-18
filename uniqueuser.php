<?php
$sqlunique = "SELECT * FROM blogusers WHERE username = '$username'";
$resultOfUnique = mysqli_query($conn, $sqlunique);

?>