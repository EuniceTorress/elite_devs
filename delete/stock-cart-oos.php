<?php
include '../connection.php';

session_start();

$accId = $_SESSION['acc_id'];

$query = "DELETE c
            FROM carts c
            INNER JOIN cart_view cv ON cv.id = c.id
            WHERE cv.sqty = 0 AND accID = '$accId'"; 

if ($conn->query($query) === TRUE) {
    echo json_encode(["success" => true, "message" => "Items removed successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error removing items: " . $conn->error]);
}

$conn->close();
?>
