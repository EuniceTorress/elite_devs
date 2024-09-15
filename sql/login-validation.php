<?php
session_start();

include 'connection.php';

$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass == $row['password']) {

            $_SESSION['acc_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            switch($_SESSION['role']){
                case 0:
                    $_SESSION['actor'] = 0;
                    $response = 'success 0';
                    break;
                case 1:
                    $_SESSION['actor'] = 1;
                    $response = 'success 1';
                    break;
                default:
                    $_SESSION['actor'] = 2;
                    $response = 'success 2';
                    break;
            }
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
