<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

include '../connection.php'; 

$accId = $_SESSION['acc_id'];

$query = "SELECT * FROM cart_view WHERE accID = '$accId'"; 
$result = $conn->query($query);

$cartItems = array();
while ($row = $result->fetch_assoc()) {
    $row['media'] = !empty($row['media'])
        ? 'data:image/jpeg;base64,' . base64_encode($row['media']) 
        : null; 

        $cartItems[] = $row;
    }

header('Content-Type: application/json; charset=utf-8');

echo json_encode($cartItems, JSON_PRETTY_PRINT);

$conn->close();
?>
