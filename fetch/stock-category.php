<?php
header('Content-Type: application/json');

include '../connection.php'; 

$query = "SELECT DISTINCT category FROM stocks"; 
$result = $conn->query($query);

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
}

echo json_encode($categories);
?>