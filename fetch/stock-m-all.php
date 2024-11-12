<?php
header("Content-Type: application/json");

include '../connection.php';

$sql = "SELECT DISTINCT date FROM memorabilia_view WHERE price IS NULL AND cost IS NULL";
$result = $conn->query($sql);

$dates = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
    }
}

echo json_encode($dates);

$conn->close();
?>
