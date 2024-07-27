<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "stockpile";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>