<?php
include '../connection.php';

header('Content-Type: application/json');

$response = [
    'inventory' => 0,
    'sales' => 0
];

$inventoryQuery = "SELECT SUM(quantity) AS total_inventory FROM stock_details"; 
$result = $conn->query($inventoryQuery);
if ($result && $row = $result->fetch_assoc()) {
    $response['inventory'] = $row['total_inventory'];
}

$salesQuery = "SELECT SUM(ol.qty * pi.unit_price) AS sales
                FROM stockpile.order_list ol
                INNER JOIN stockpile.price_insert pi ON ol.stock_no = pi.snum "; 
$result = $conn->query($salesQuery);
if ($result && $row = $result->fetch_assoc()) {
    $response['sales'] = $row['sales'];
}

echo json_encode($response);
?>
