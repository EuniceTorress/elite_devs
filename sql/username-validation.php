<?php
include 'connection.php';

$checkUsername = $_GET['username'] ?? '';

$sql = "SELECT username FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $checkUsername);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo 'taken';
} else {
    echo 'available';
}

$stmt->close();
$conn->close();
?>
