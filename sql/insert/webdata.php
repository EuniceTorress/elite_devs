<?php

include '../connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['email']) || !isset($_SESSION['code_count'])) {
    die("Session variables are not set.");
}

$emaill = $_POST['email_account'];


?>
