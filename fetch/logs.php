<?php
header("Content-Type: application/json");

include '../connection.php';

$sql = "SELECT ui.name, u.role, l.action, l.table_name, l.date, l.description
        FROM logs l
        LEFT JOIN users u ON l.acc_id = u.id
        LEFT JOIN user_info ui ON l.acc_id = ui.account_id
        ORDER BY l.date DESC";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
