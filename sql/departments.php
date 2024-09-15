<?php
include 'connection.php';

$dep_sql = $conn->query("SELECT `data` FROM web_data WHERE `type` = 'department'");

$data = [];

while ($row = $dep_sql->fetch_assoc()) {
    $data[] = $row['data'];
}

header('Content-Type: application/json');

echo json_encode($data);
?>
