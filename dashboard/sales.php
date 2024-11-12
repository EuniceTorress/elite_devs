<?php

include '../connection.php';

$year = $_GET['year']; 

$salesData = [];

$query = "SELECT MONTH(timestamp) AS month, SUM(ol.qty * pi.unit_price) AS total_sales 
        FROM order_list ol
        INNER JOIN price_insert pi ON ol.stock_no = pi.snum
        WHERE YEAR(timestamp) = ? 
        GROUP BY MONTH(timestamp)";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $year);
$stmt->execute();
$result = $stmt->get_result();

for ($i = 1; $i <= 12; $i++) {
    $salesData[$i] = 0;
}

while ($row = $result->fetch_assoc()) {
    $salesData[(int)$row['month']] = (float)$row['total_sales'];
}

echo json_encode(array_values($salesData));
?>
