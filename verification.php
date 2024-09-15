<?php
session_start();

$e_acc = $_POST['email_account'];
$verification_code = $_POST['verification_code'];

$error2 = "failed";



    if (isset($_SESSION['code']) && $_SESSION['code'] == $verification_code && $_SESSION['user_email'] == $e_acc) {
        $error2 = "success";
        unset($_SESSION['code']); 
        sleep(1);
    }

echo json_encode(['error2' => $error2]);
?>
