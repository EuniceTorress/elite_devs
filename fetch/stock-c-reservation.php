<?php
include '../connection.php';

session_start();

$accId = $_SESSION['acc_id'];

$sql = "SELECT * FROM reservation WHERE account_id = '$accId'";
$result = $conn->query($sql);

$reservations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $detailsArray = json_decode($row['details'], true);
        
        if (!$detailsArray) { 
            $details = explode(',', $row['details']);
            $detailsArray = [
                [
                    'id' => trim($details[0]),
                    'item_name' => trim($details[1]),
                    'description' => trim($details[2]),
                    'quantity' => trim($details[3]),
                    'price' => trim($details[4]),
                ]
            ];
        }
        
        $row['details'] = $detailsArray;
        $reservations[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($reservations);
?>
