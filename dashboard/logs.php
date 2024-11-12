<?php
include '../connection.php'; 

$sql = "SELECT action, date, description 
        FROM logs
        WHERE table_name = 'stocks' 
        AND description NOT LIKE '%price%'
        AND description NOT LIKE '%cost%'
        AND description NOT LIKE '%media%'
        AND description NOT LIKE '%stock name%'
        ORDER BY date DESC 
        LIMIT 10;
        "; 
$result = $conn->query($sql);

$logs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logs[] = [
            'action' => $row['action'],
            'date' => $row['date'],
            'description' => $row['description']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($logs);
?>
