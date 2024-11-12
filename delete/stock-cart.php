<?php
include '../connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $result = $conn->query("DELETE FROM carts WHERE id = '$id'"); 

    if ($result) {
        echo json_encode(['success' => true]); 
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove item.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
