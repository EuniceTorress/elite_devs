<?php
include('../connection.php');

$month = isset($_GET['month']) ? $_GET['month'] : date('m'); 
$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); 

$sql = "
SELECT 
    (SELECT SUM(ol.qty * pi.unit_price) 
     FROM order_list ol
     INNER JOIN price_insert pi ON ol.stock_no = pi.snum
     WHERE MONTH(ol.timestamp) = ? 
     AND YEAR(ol.timestamp) = ?  
    ) AS salesRevenue,

    (SELECT AVG(i.qty) 
     FROM stockpile.inventory i
     WHERE MONTH(i.date) = ? AND YEAR(i.date) = ?
    ) AS stockAvailability,

    (SELECT SUM(qty) FROM order_list WHERE MONTH(timestamp) = ? 
    AND YEAR(timestamp) = ?  ) AS totalSales,

    (SELECT SUM(qty) FROM inventory WHERE MONTH(date) =  ? 
    AND YEAR(date) = ?  ) AS totalStock;
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("iiiiiiii", $month, $year, $month, $year, $month, $year, $month, $year);

$stmt->execute();

$result = $stmt->get_result();

$data = $result->fetch_assoc();

$totalSales = $data['totalSales'];
$totalStock = $data['totalStock'];

$response['inventoryTurnover'] = ($totalStock > 0) ? round(($totalSales / $totalStock) * 100, 2) : 0;

$response['salesRevenue'] = $data['salesRevenue'];
$response['totalSales'] = $totalSales;
$response['totalStock'] = $totalStock;
$response['stockAvailability'] = $data['stockAvailability'];

echo json_encode($response);

$stmt->close();
?>
