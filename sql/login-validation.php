<?php
session_start();

include 'connection.php';

$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass == $row['password']) {

            $_SESSION['acc_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            $response = 'success';
        } else {
            $response = 'Incorrect password!';
        }
    } else {
        $response = 'No username found!';
    }
} else {
    $response = 'Invalid request method!';
}

echo json_encode($response);
?>
