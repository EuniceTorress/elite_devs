<?php

include '../connection.php';

$sql = "SELECT DISTINCT rate_type FROM facilities WHERE `type` = 'facility'";
$result = $conn->query($sql);

$rateTypes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rateTypes[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($rateTypes);
?>
