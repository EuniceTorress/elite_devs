<?php
header('Content-Type: application/json');

include '../connection.php';

$sql = "SELECT stock_no, `name`, rqty AS qty FROM stock_details";
$result = $conn->query($sql);

$items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

echo json_encode($items);

$conn->close();
?>
