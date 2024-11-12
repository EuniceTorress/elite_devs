<?php
include('../connection.php'); 

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

$query = "SELECT * FROM stock_details WHERE total_sales > 0 ORDER BY total_sales DESC LIMIT $limit";
$result = $conn->query($query);

$products = [];
while ($row = $result->fetch_assoc()) {
    $row['media'] = base64_encode($row['media']);
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);
?>
