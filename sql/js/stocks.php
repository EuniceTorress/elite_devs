<?php
header('Content-Type: application/json');

include '../connection.php';

$sql = "SELECT DISTINCT title FROM stock_details";
$result = $conn->query($sql);

$items = array();
while ($row = $result->fetch_assoc()) {
    $items[] = $row['title'];
}

$conn->close();

echo json_encode($items);
?>
