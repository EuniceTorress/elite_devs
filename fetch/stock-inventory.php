<?php

require_once '../connection.php'; 

$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'latest_inventory_date';
$sortOrder = isset($_GET['order']) && strtoupper($_GET['order']) === 'DESC' ? 'DESC' : 'ASC'; 

$validSortColumns = ['stock_no', 'name', 'category', 'rqty', 'unit_price', 'unit_cost', 'latest_inventory_date'];
if (!in_array($sortColumn, $validSortColumns)) {
    $sortColumn = 'latest_inventory_date'; 
    $sortOrder = 'DESC';
}

$sql = "SELECT * FROM stock_details ORDER BY $sortColumn $sortOrder";
$result = $conn->query($sql);

$stocks = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imageData = $row['media'];
        error_log("Image size: " . strlen($imageData));

        $base64Image = base64_encode($imageData);

        $stocks[] = [
            'category' => $row['category'],
            'desc' => $row['description'],
            'title' => $row['title'],
            'id' => $row['stock_no'],
            'name' => $row['name'],
            'quantity' => $row['quantity'],
            'unit_price' => $row['unit_price'],
            'unit_cost' => $row['unit_cost'],
            'date' => $row['latest_inventory_date'],
            'nqty' => $row['new_qty'],
            'rqty' => $row['rqty'],
            'media' => !empty($base64Image) ? 'data:image/jpeg;base64,' . $base64Image : '../../src/img/no-image.jpg'
        ];
    }
} else {
    echo json_encode([]); 
    exit;
}

$conn->close();

echo json_encode($stocks);

?>
