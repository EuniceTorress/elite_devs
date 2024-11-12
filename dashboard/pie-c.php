<?php
include '../connection.php';

$data = array();

try {
    $query = "SELECT category, COUNT(*) AS total FROM stock_details GROUP BY category";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'category' => $row['category'],
            'total' => (int)$row['total']
        );
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
