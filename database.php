<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "password";
$dbName = "rane's_fharal";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>