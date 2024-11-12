<?php
include('../connection.php');
header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit;
}

$query = "SELECT * FROM stock_details";

$result = mysqli_query($conn, $query);

$products = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (isset($row['media']) && !empty($row['media'])) {
            $row['media'] = 'data:image/jpeg;base64,' . base64_encode($row['media']);
        }
        $products[] = array_map('htmlspecialchars', $row);
    }

    echo json_encode($products);
} else {
    echo json_encode(['error' => 'Failed to fetch products: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
