<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "webprog";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    // Log detailed error message
    error_log("Connection failed: " . mysqli_connect_error());
    die("Something went wrong!");
}
