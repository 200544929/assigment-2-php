<?php
$server = "172.31.22.43";
$username = "Dhruv200544929";
$password = "n0LcH7Xjxz";
$dbname = "Dhruv200544929";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
