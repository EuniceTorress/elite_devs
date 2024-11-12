<?php
header('Content-Type: application/json');
include '../connection.php';  

$sql = "SELECT id, `name` AS `facility`, price, `date`, rate, `status`
        FROM facility;";
$result = $conn->query($sql);

$facility = [];

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if (!$result) {
    echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
    exit();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        if ($row['rate']) {
            $row['rate'] = explode('~', $row['rate']);
        } else {
            $row['rate'] = [];
        }

        $facility[] = $row;
    }
} else {
    echo json_encode([]);  
    exit();
}

$conn->close(); 

echo json_encode($facility);
?>
