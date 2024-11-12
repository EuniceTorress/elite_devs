<?php

require_once '../connection.php'; 

if (isset($_GET['stock_no'])) {
    $stockNo = $_GET['stock_no']; 
    $sql = "SELECT stock_no as `id`, title, description AS `desc`, category, unit_price, unit_cost, quantity, rqty
            FROM stock_details WHERE stock_no = '$stockNo'"; 
    $result = mysqli_query($conn, $sql);

    if ($stockDetails = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'success' => true,
            'id' => $stockDetails['id'],
            'title' => $stockDetails['title'],
            'desc' => $stockDetails['desc'],
            'category' => $stockDetails['category'],
            'unit_price' => $stockDetails['unit_price'],
            'unit_cost' => $stockDetails['unit_cost'],
            'quantity' => $stockDetails['quantity'],
            'rqty' => $stockDetails['rqty'],
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Stock not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No stock number provided.']);
}

?>
