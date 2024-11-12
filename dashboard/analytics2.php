<?php
require_once('../connection.php');

$query = "SELECT name, rqty, unit FROM stock_details";  
$result = $conn->query($query);

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
