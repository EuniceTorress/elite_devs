<?php

include '../connection.php';

$sql = "SELECT * FROM stock_details";
$result = $conn->query($sql);

$stocks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stocks[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

echo json_encode($stocks);
?>