<?php
include '../connection.php';

$sql = "SELECT name FROM stock_details";
$result = $conn->query($sql);

$items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = array('name' => $row['name']); 
    }
}

header('Content-Type: application/json');
echo json_encode($items);

$conn->close();
?>
